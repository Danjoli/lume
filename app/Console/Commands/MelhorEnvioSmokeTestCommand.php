<?php

namespace App\Console\Commands;

use App\Actions\Shipments\GenerateLabelAction;
use App\Actions\Shipments\PurchaseLabelAction;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\ShipmentStatus;
use App\Enums\UserStatus;
use App\Models\Address;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\User;
use App\Services\Store\Shipping\MelhorEnvioService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class MelhorEnvioSmokeTestCommand extends Command
{
    protected $signature = 'melhor-envio:smoke-test
        {--service= : ID específico do serviço retornado pela cotação}
        {--prepare : Cria o pedido técnico e adiciona o envio ao carrinho do Melhor Envio}
        {--purchase : Compra, gera e obtém a URL da etiqueta (implica --prepare)}';

    protected $description = 'Executa um teste controlado da integração com o Melhor Envio Sandbox';

    public function handle(
        MelhorEnvioService $melhorEnvio,
        GenerateLabelAction $generateLabel,
        PurchaseLabelAction $purchaseLabel,
    ): int {
        if (config('services.melhor_envio.environment') !== 'sandbox') {
            $this->error('Este comando só pode ser executado com MELHOR_ENVIO_ENVIRONMENT=sandbox.');

            return self::FAILURE;
        }

        try {
            [$user, $address, $cart, $book] = $this->testContext();
            $options = $melhorEnvio->calculate($address, $cart);

            if ($options->isEmpty()) {
                $this->error('O Sandbox não retornou opções de frete para o cenário técnico.');

                return self::FAILURE;
            }

            $this->table(
                ['ID', 'Transportadora', 'Serviço', 'Preço', 'Prazo'],
                $options->map(fn (array $option) => [
                    $option['id'], $option['carrier'], $option['name'],
                    'R$ '.number_format($option['price'], 2, ',', '.'),
                    $option['delivery_min_days'].'–'.$option['delivery_max_days'].' dias',
                ])->all()
            );

            $selected = $this->option('service')
                ? $options->firstWhere('id', (string) $this->option('service'))
                : $options->first();

            if (! $selected) {
                $this->error('O ID informado não está entre os serviços retornados pela cotação.');

                return self::FAILURE;
            }

            if (! $this->option('prepare') && ! $this->option('purchase')) {
                $this->info('Cotação concluída. Use --prepare para criar o envio técnico ou --purchase para executar o fluxo completo.');

                return self::SUCCESS;
            }

            $shipment = $this->createOrder($user, $address, $book, $selected);
            $generateLabel->execute($shipment);
            $this->info("Envio técnico #{$shipment->id} preparado no Melhor Envio.");

            if ($this->option('purchase')) {
                if (! $this->confirm('Comprar e gerar uma etiqueta no Sandbox agora?', false)) {
                    $this->warn('Compra não executada. O envio ficou preparado para teste no painel.');

                    return self::SUCCESS;
                }

                $shipment = $purchaseLabel->execute($shipment->refresh());
                $this->info('Etiqueta gerada com sucesso: '.$shipment->label_url);
            }

            $this->line('Abra no painel: '.route('admin.shipments.show', $shipment));

            return self::SUCCESS;
        } catch (Throwable $exception) {
            report($exception);
            $this->error($exception->getMessage());

            return self::FAILURE;
        }
    }

    /**
     * @return array{User, Address, Cart, Book}
     */
    private function testContext(): array
    {
        $book = Book::query()->where('is_active', true)->where('stock', '>', 0)->firstOrFail();
        $user = User::withTrashed()->updateOrCreate(
            ['email' => 'smoke-test-melhor-envio@lume.test'],
            ['name' => 'Teste Melhor Envio', 'password' => Str::password(24), 'status' => UserStatus::ACTIVE]
        );
        $user->restore();
        $user->forceFill(['email_verified_at' => now()])->save();

        $address = Address::updateOrCreate(
            ['user_id' => $user->id, 'label' => 'Teste Sandbox'],
            [
                'recipient_name' => 'Destinatário Teste', 'phone' => '(21) 99999-9999',
                'street' => 'Rua da Assembleia', 'number' => '10', 'complement' => null,
                'neighborhood' => 'Centro', 'city' => 'Rio de Janeiro', 'state' => 'RJ',
                'cep' => '20011-901', 'is_default' => true,
            ]
        );
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cart->items()->delete();
        $cart->items()->create([
            'book_id' => $book->id,
            'quantity' => 1,
            'unit_price' => $book->sale_price ?? $book->price,
        ]);

        return [$user, $address, $cart->load('items.book'), $book];
    }

    /**
     * @param  array<string, mixed>  $shipping
     */
    private function createOrder(User $user, Address $address, Book $book, array $shipping): Shipment
    {
        return DB::transaction(function () use ($user, $address, $book, $shipping) {
            $price = (float) ($book->sale_price ?? $book->price);
            $order = Order::create([
                'user_id' => $user->id, 'status' => OrderStatus::PROCESSING,
                'payment_status' => PaymentStatus::PAID, 'payment_method' => PaymentMethod::PIX,
                'subtotal' => $price, 'shipping' => $shipping['price'], 'discount' => 0,
                'total' => $price + $shipping['price'], 'cpf' => '529.982.247-25',
                'recipient_name' => $address->recipient_name, 'phone' => $address->phone,
                'street' => $address->street, 'number' => $address->number,
                'complement' => $address->complement, 'neighborhood' => $address->neighborhood,
                'city' => $address->city, 'state' => $address->state, 'cep' => $address->cep,
                'gateway' => 'sandbox', 'paid_at' => now(),
            ]);
            $order->items()->create([
                'book_id' => $book->id, 'title' => $book->title,
                'quantity' => 1, 'price' => $price,
            ]);

            return $order->shipment()->create([
                'carrier' => $shipping['carrier'], 'service' => $shipping['id'],
                'status' => ShipmentStatus::PENDING, 'shipping_cost' => $shipping['price'],
                'delivery_min_days' => $shipping['delivery_min_days'],
                'delivery_max_days' => $shipping['delivery_max_days'], 'gateway_payload' => $shipping,
            ]);
        });
    }
}
