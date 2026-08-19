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
        Schema::create('settings', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Loja
            |--------------------------------------------------------------------------
            */

            $table->string('store_name')
                ->default('Lume');

            $table->string('company_name')
                ->nullable();

            $table->string('cnpj', 18)
                ->nullable();

            $table->text('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Contato
            |--------------------------------------------------------------------------
            */

            $table->string('email')
                ->nullable();

            $table->string('phone', 20)
                ->nullable();

            $table->string('whatsapp', 20)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Endereço
            |--------------------------------------------------------------------------
            */

            $table->string('cep', 9)
                ->nullable();

            $table->string('street')
                ->nullable();

            $table->string('number', 20)
                ->nullable();

            $table->string('complement')
                ->nullable();

            $table->string('neighborhood')
                ->nullable();

            $table->string('city')
                ->nullable();

            $table->string('state', 2)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Redes Sociais
            |--------------------------------------------------------------------------
            */

            $table->string('instagram')
                ->nullable();

            $table->string('facebook')
                ->nullable();

            $table->string('youtube')
                ->nullable();

            $table->string('tiktok')
                ->nullable();

            $table->string('linkedin')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Aparência
            |--------------------------------------------------------------------------
            */

            $table->string('logo')
                ->nullable();

            $table->string('favicon')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            $table->string('meta_title')
                ->nullable();

            $table->text('meta_description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Vendas
            |--------------------------------------------------------------------------
            */

            $table->decimal(
                'minimum_order_amount',
                10,
                2
            )->default(0);

            $table->boolean(
                'allow_out_of_stock_sales'
            )->default(false);

            $table->string('currency', 3)
                ->default('BRL');

            /*
            |--------------------------------------------------------------------------
            | Frete
            |--------------------------------------------------------------------------
            */

            $table->string('origin_cep', 9)
                ->nullable();

            $table->decimal(
                'free_shipping_threshold',
                10,
                2
            )->nullable();

            /*
            |--------------------------------------------------------------------------
            | Estoque
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger(
                'low_stock_threshold'
            )->default(5);

            /*
            |--------------------------------------------------------------------------
            | Avaliações
            |--------------------------------------------------------------------------
            */

            $table->boolean(
                'reviews_require_purchase'
            )->default(true);

            $table->boolean(
                'reviews_auto_approve'
            )->default(false);

            /*
            |--------------------------------------------------------------------------
            | E-mail
            |--------------------------------------------------------------------------
            */

            $table->string('sender_name')
                ->nullable();

            $table->string('sender_email')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
