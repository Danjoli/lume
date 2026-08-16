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
        Schema::create('coupons', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Identificação
            |--------------------------------------------------------------------------
            */

            $table->string('code')->unique();

            $table->string('slug')->unique();

            $table->string('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Desconto
            |--------------------------------------------------------------------------
            */

            $table->string('type');

            $table->decimal('value', 10, 2);

            /*
            |--------------------------------------------------------------------------
            | Regras
            |--------------------------------------------------------------------------
            */

            $table->decimal('minimum_amount', 10, 2)
                ->default(0);

            $table->unsignedInteger('usage_limit')
                ->nullable();

            $table->unsignedInteger('used_count')
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Validade
            |--------------------------------------------------------------------------
            */

            $table->timestamp('starts_at')
                ->nullable();

            $table->timestamp('expires_at')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            $table->index('code');

            $table->index('type');

            $table->index('is_active');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
