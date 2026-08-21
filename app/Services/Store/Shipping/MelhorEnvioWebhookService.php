<?php

namespace App\Services\Store\Shipping;

use App\Enums\ShipmentStatus;
use App\Models\Shipment;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class MelhorEnvioWebhookService
{
    /**
     * @param  array{event: string, data: array<string, mixed>}  $payload
     */
    public function handle(array $payload): void
    {
        DB::transaction(function () use ($payload): void {
            $shipment = $this->findShipment($payload['data']);

            if (! $shipment) {
                return;
            }

            $eventHash = hash('sha256', json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
            $history = $shipment->tracking_history ?? [];

            if (collect($history)->contains(fn ($entry) => is_array($entry) && ($entry['_webhook_hash'] ?? null) === $eventHash)) {
                return;
            }

            $data = $payload['data'];
            $incomingStatus = $this->mapStatus((string) ($data['status'] ?? $payload['event']));
            $status = $this->resolveStatus($shipment->status, $incomingStatus);

            $history[] = [
                '_webhook_hash' => $eventHash,
                'event' => $payload['event'],
                'status' => $data['status'] ?? null,
                'tracking' => $data['tracking'] ?? null,
                'tracking_url' => $data['tracking_url'] ?? null,
                'received_at' => now()->toIso8601String(),
                'data' => $data,
            ];

            $shipment->update([
                'melhor_envio_order_id' => $data['id'] ?? $shipment->melhor_envio_order_id,
                'melhor_envio_protocol' => $data['protocol'] ?? $shipment->melhor_envio_protocol,
                'tracking_code' => $data['tracking'] ?? $shipment->tracking_code,
                'tracking_url' => $data['tracking_url'] ?? $data['self_tracking'] ?? $shipment->tracking_url,
                'tracking_history' => $history,
                'status' => $status,
                'shipped_at' => in_array($status, [ShipmentStatus::SHIPPED, ShipmentStatus::DELIVERED, ShipmentStatus::RETURNED], true)
                    ? $this->date($data['posted_at'] ?? null, $shipment->shipped_at ?? now())
                    : $shipment->shipped_at,
                'delivered_at' => $status === ShipmentStatus::DELIVERED
                    ? $this->date($data['delivered_at'] ?? null, $shipment->delivered_at ?? now())
                    : $shipment->delivered_at,
            ]);
        });
    }

    /**
     * @param  array<string, mixed>  $data
     */
    private function findShipment(array $data): ?Shipment
    {
        if (! filled($data['id'] ?? null) && ! filled($data['protocol'] ?? null)) {
            return null;
        }

        return Shipment::query()
            ->where(function ($query) use ($data): void {
                if (filled($data['id'] ?? null)) {
                    $query->where('melhor_envio_order_id', $data['id']);
                }

                if (filled($data['protocol'] ?? null)) {
                    $method = filled($data['id'] ?? null) ? 'orWhere' : 'where';
                    $query->{$method}('melhor_envio_protocol', $data['protocol']);
                }
            })
            ->lockForUpdate()
            ->first();
    }

    private function mapStatus(string $status): ?ShipmentStatus
    {
        $status = strtolower(str_replace('order.', '', $status));

        return match ($status) {
            'created', 'pending' => ShipmentStatus::PENDING,
            'released', 'generated' => ShipmentStatus::PREPARING,
            'received', 'posted', 'in_transit' => ShipmentStatus::SHIPPED,
            'delivered' => ShipmentStatus::DELIVERED,
            'undelivered', 'returned' => ShipmentStatus::RETURNED,
            'cancelled', 'canceled' => ShipmentStatus::CANCELLED,
            default => null,
        };
    }

    private function resolveStatus(ShipmentStatus $current, ?ShipmentStatus $incoming): ShipmentStatus
    {
        if (! $incoming || in_array($current, [ShipmentStatus::DELIVERED, ShipmentStatus::RETURNED, ShipmentStatus::CANCELLED], true)) {
            return $current;
        }

        if (in_array($incoming, [ShipmentStatus::RETURNED, ShipmentStatus::CANCELLED], true)) {
            return $incoming;
        }

        $rank = [
            ShipmentStatus::PENDING->value => 0,
            ShipmentStatus::PREPARING->value => 1,
            ShipmentStatus::SHIPPED->value => 2,
            ShipmentStatus::DELIVERED->value => 3,
        ];

        return $rank[$incoming->value] >= ($rank[$current->value] ?? 0) ? $incoming : $current;
    }

    private function date(mixed $value, mixed $fallback): mixed
    {
        if (! is_string($value) || $value === '') {
            return $fallback;
        }

        try {
            return CarbonImmutable::parse($value);
        } catch (\Throwable) {
            return $fallback;
        }
    }
}
