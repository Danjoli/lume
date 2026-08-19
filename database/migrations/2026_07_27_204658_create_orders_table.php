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

            /*
            |--------------------------------------------------------------------------
            | Usuário
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->string('status')
                ->default('pending');

            $table->string('payment_status')
                ->default('pending');

            /*
            |--------------------------------------------------------------------------
            | Pagamento
            |--------------------------------------------------------------------------
            */

            $table->string('payment_method');

            $table->string('gateway')
                ->nullable();

            $table->string('gateway_payment_id')
                ->nullable();

            $table->timestamp('paid_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Valores
            |--------------------------------------------------------------------------
            */

            $table->decimal('subtotal', 10, 2);

            $table->decimal('shipping', 10, 2)
                ->default(0);

            $table->decimal('discount', 10, 2)
                ->default(0);

            $table->decimal('total', 10, 2);

            /*
            |--------------------------------------------------------------------------
            | Dados do cliente
            |--------------------------------------------------------------------------
            */

            $table->string('cpf', 14);

            /*
            |--------------------------------------------------------------------------
            | Snapshot do endereço de entrega
            |--------------------------------------------------------------------------
            */

            $table->string('recipient_name');

            $table->string('phone');

            $table->string('street');

            $table->string('number');

            $table->string('complement')
                ->nullable();

            $table->string('neighborhood');

            $table->string('city');

            $table->string('state', 2);

            $table->string('cep', 10);

            /*
            |--------------------------------------------------------------------------
            | Datas
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            $table->index('status');

            $table->index('payment_status');

            $table->index('payment_method');

            $table->index('gateway_payment_id');
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
