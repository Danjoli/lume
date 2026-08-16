<?php

namespace App\Services\Store\Customer;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AddressService
{
    public function all(): Collection
    {
        return auth()
            ->user()
            ->addresses()
            ->orderByDesc('is_default')
            ->latest()
            ->get();
    }

    public function store(
        array $data
    ): Address {
        return DB::transaction(function () use ($data) {

            $user = auth()->user();

            if (! $user->addresses()->exists()) {
                $data['is_default'] = true;
            }

            if ($data['is_default'] ?? false) {
                $user->addresses()
                    ->update([
                        'is_default' => false,
                    ]);
            }

            return $user
                ->addresses()
                ->create($data);
        });
    }

    public function update(
        Address $address,
        array $data
    ): Address {
        $this->ensureOwnership($address);

        return DB::transaction(function () use (
            $address,
            $data
        ) {

            if ($data['is_default'] ?? false) {
                auth()
                    ->user()
                    ->addresses()
                    ->whereKeyNot($address->id)
                    ->update([
                        'is_default' => false,
                    ]);
            }

            $address->update($data);

            return $address->refresh();
        });
    }

    public function destroy(
        Address $address
    ): void {
        $this->ensureOwnership($address);

        $wasDefault = $address->is_default;

        $address->delete();

        if ($wasDefault) {
            $nextAddress = auth()
                ->user()
                ->addresses()
                ->latest()
                ->first();

            if ($nextAddress) {
                $nextAddress->update([
                    'is_default' => true,
                ]);
            }
        }
    }

    public function makeDefault(
        Address $address
    ): Address {
        $this->ensureOwnership($address);

        return DB::transaction(function () use ($address) {

            auth()
                ->user()
                ->addresses()
                ->update([
                    'is_default' => false,
                ]);

            $address->update([
                'is_default' => true,
            ]);

            return $address->refresh();
        });
    }

    public function ensureOwnership(
        Address $address
    ): void {
        abort_unless(
            $address->user_id === auth()->id(),
            403
        );
    }
}
