<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Pedido
            |--------------------------------------------------------------------------
            */

            $table->foreignId('order_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Transportadora / Serviço
            |--------------------------------------------------------------------------
            */

            $table->string('carrier')
                ->nullable();

            $table->string('service')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Rastreamento
            |--------------------------------------------------------------------------
            */

            $table->string('tracking_code')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->string('status')
                ->default('pending');

            /*
            |--------------------------------------------------------------------------
            | Valores
            |--------------------------------------------------------------------------
            */

            $table->decimal('shipping_cost', 10, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Datas logísticas
            |--------------------------------------------------------------------------
            */

            $table->timestamp('shipped_at')
                ->nullable();

            $table->timestamp('delivered_at')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            $table->index('tracking_code');

            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
