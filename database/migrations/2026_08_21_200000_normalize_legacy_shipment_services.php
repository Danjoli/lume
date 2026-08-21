<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $services = [
            'PAC' => ['id' => '1', 'carrier' => 'Correios'],
            'SEDEX' => ['id' => '2', 'carrier' => 'Correios'],
            'Express' => ['id' => '3', 'carrier' => 'Jadlog'],
            'Standard' => ['id' => '4', 'carrier' => 'Jadlog'],
        ];

        foreach ($services as $legacyName => $service) {
            DB::table('shipments')
                ->where('service', $legacyName)
                ->update([
                    'service' => $service['id'],
                    'carrier' => $service['carrier'],
                ]);
        }
    }

    public function down(): void
    {
        // A conversão não é revertida porque os IDs são o formato válido da integração.
    }
};
