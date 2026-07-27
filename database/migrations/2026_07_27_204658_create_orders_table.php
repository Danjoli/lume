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
        Schema::create('orders', function (Blueprint $table) {
            
            $table->id();

             $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Status pedido
            $table->string('status')
                ->default('pending');

            // Status pagamento
            $table->string('payment_status')
                ->default('pending');

            // Valores
            $table->decimal('subtotal',10,2);
            $table->decimal('shipping',10,2)
                ->default(0);
            $table->decimal('discount',10,2)
                ->default(0);
            $table->decimal('total',10,2);

            // Snapshot endereço
            $table->string('recipient_name');
            $table->string('phone');
            $table->string('street');
            $table->string('number');
            $table->string('complement')
                ->nullable();
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state',2);
            $table->string('cep',10);

            // Pagamento
            $table->string('gateway')
                ->nullable();

            $table->string('gateway_payment_id')
                ->nullable();

            $table->timestamp('paid_at')
                ->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
