<?php

namespace App\Services\Payments;

use App\Enums\PaymentMethod;
use App\Models\Order;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class AsaasService
{
    private function client(): PendingRequest
    {
        $key = (string) config('services.asaas.api_key');

        if ($key === '') {
            $environment = strtoupper((string) config('services.asaas.environment', 'sandbox'));

            throw new RuntimeException("Configure ASAAS_{$environment}_API_KEY no arquivo .env.");
        }

        return Http::baseUrl(rtrim((string) config('services.asaas.base_url'), '/'))
            ->acceptJson()
            ->withHeaders(['access_token' => $key])
            ->timeout(30)
            ->retry(2, 300, throw: false);
    }

    public function createCharge(Order $order): Order
    {
        if ($order->gateway_payment_id) {
            return $order;
        }

        $order->loadMissing('user');
        $customerId = $this->findOrCreateCustomer($order);
        $dueDate = now()->addDays((int) config('services.asaas.due_days', 3))->toDateString();

        $response = $this->client()->post('/payments', [
            'customer' => $customerId,
            'billingType' => $this->billingType($order->payment_method),
            'value' => (float) $order->total,
            'dueDate' => $dueDate,
            'description' => "Pedido Lume #{$order->id}",
            'externalReference' => (string) $order->id,
            'postalService' => false,
        ]);

        if ($response->failed()) {
            throw new RuntimeException($this->errorMessage($response->json()));
        }

        $payment = $response->json();
        $data = [
            'gateway' => 'asaas',
            'gateway_customer_id' => $customerId,
            'gateway_payment_id' => $payment['id'],
            'gateway_status' => $payment['status'] ?? 'PENDING',
            'payment_url' => $payment['invoiceUrl'] ?? null,
            'bank_slip_url' => $payment['bankSlipUrl'] ?? null,
            'payment_due_date' => $payment['dueDate'] ?? $dueDate,
            'gateway_error' => null,
        ];

        if ($order->payment_method === PaymentMethod::PIX) {
            $pix = $this->client()->get("/payments/{$payment['id']}/pixQrCode");
            if ($pix->successful()) {
                $data['pix_payload'] = $pix->json('payload');
                $data['pix_qr_code'] = $pix->json('encodedImage');
            }
        }

        $order->update($data);

        return $order->refresh();
    }

    public function refresh(Order $order): Order
    {
        if (! $order->gateway_payment_id) {
            return $this->createCharge($order);
        }

        $response = $this->client()->get("/payments/{$order->gateway_payment_id}");
        if ($response->failed()) {
            throw new RuntimeException($this->errorMessage($response->json()));
        }

        $order->update(['gateway_status' => $response->json('status')]);

        return $order->refresh();
    }

    public function refund(Order $order): void
    {
        $response = $this->client()->post("/payments/{$order->gateway_payment_id}/refund");
        if ($response->failed()) {
            throw new RuntimeException($this->errorMessage($response->json()));
        }
    }

    public function cancel(Order $order): void
    {
        if (! $order->gateway_payment_id || $order->isPaid()) {
            return;
        }

        $response = $this->client()->delete("/payments/{$order->gateway_payment_id}");
        if ($response->failed()) {
            throw new RuntimeException($this->errorMessage($response->json()));
        }
    }

    private function findOrCreateCustomer(Order $order): string
    {
        if ($order->gateway_customer_id) {
            return $order->gateway_customer_id;
        }

        $cpf = preg_replace('/\D/', '', $order->cpf);
        $lookup = $this->client()->get('/customers', ['cpfCnpj' => $cpf, 'limit' => 1]);
        if ($lookup->successful() && $lookup->json('totalCount', 0) > 0) {
            return $lookup->json('data.0.id');
        }

        $response = $this->client()->post('/customers', [
            'name' => $order->recipient_name,
            'email' => $order->user->email,
            'cpfCnpj' => $cpf,
            'mobilePhone' => preg_replace('/\D/', '', $order->phone),
            'postalCode' => preg_replace('/\D/', '', $order->cep),
            'address' => $order->street,
            'addressNumber' => $order->number,
            'complement' => $order->complement,
            'province' => $order->neighborhood,
            'externalReference' => 'user-'.$order->user_id,
        ]);

        if ($response->failed()) {
            throw new RuntimeException($this->errorMessage($response->json()));
        }

        return $response->json('id');
    }

    private function billingType(PaymentMethod $method): string
    {
        return match ($method) {
            PaymentMethod::PIX => 'PIX',
            PaymentMethod::BOLETO => 'BOLETO',
            PaymentMethod::CARD => 'CREDIT_CARD',
        };
    }

    private function errorMessage(?array $body): string
    {
        return collect($body['errors'] ?? [])->pluck('description')->filter()->implode(' ') ?: 'Não foi possível comunicar com o Asaas.';
    }
}
