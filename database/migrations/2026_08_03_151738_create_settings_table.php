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

            $table->string('store_name');

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

            $table->string('email');

            $table->string('phone')
                ->nullable();

            $table->string('whatsapp')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Endereço
            |--------------------------------------------------------------------------
            */

            $table->string('cep', 10)
                ->nullable();

            $table->string('street')
                ->nullable();

            $table->string('number')
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

            $table->string('facebook')
                ->nullable();

            $table->string('instagram')
                ->nullable();

            $table->string('linkedin')
                ->nullable();

            $table->string('youtube')
                ->nullable();

            $table->string('tiktok')
                ->nullable();

            $table->string('twitter')
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

            $table->string('keywords')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Pagamento
            |--------------------------------------------------------------------------
            */

            $table->string('payment_gateway')
                ->nullable();

            $table->string('pix_key')
                ->nullable();

            $table->string('currency')
                ->default('BRL');

            /*
            |--------------------------------------------------------------------------
            | Frete
            |--------------------------------------------------------------------------
            */

            $table->string('default_carrier')
                ->nullable();

            $table->string('origin_zipcode', 10)
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Email
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
