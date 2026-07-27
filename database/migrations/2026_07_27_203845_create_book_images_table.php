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
        Schema::create('book_images', function (Blueprint $table) {
            $table->id();

            // Livro relacionado
            $table->foreignId('book_id')
                ->constrained()
                ->cascadeOnDelete();

            // Caminho da imagem
            $table->string('image');

            // Ordem de exibição
            $table->unsignedInteger('sort_order')
                ->default(0);

            // Imagem principal
            $table->boolean('is_primary')
                ->default(false);

            $table->timestamps();

            // Índices
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_images');
    }
};
