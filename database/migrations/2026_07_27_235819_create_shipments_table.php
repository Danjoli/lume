<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();

            // Pedido relacionado
            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            // Transportadora
            $table->string('carrier')->nullable();

            // Código de rastreio
            $table->string('tracking_code')->nullable();

            // Serviço contratado
            $table->string('service')->nullable();

            // Status do envio
            $table->string('status')
                ->default('pending');

            // Valores
            $table->decimal('shipping_cost', 10, 2)
                ->default(0);

            // Datas importantes
            $table->timestamp('shipped_at')
                ->nullable();

            $table->timestamp('delivered_at')
                ->nullable();

            $table->timestamps();

            $table->index('tracking_code');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
