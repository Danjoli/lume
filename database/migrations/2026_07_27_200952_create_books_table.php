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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // Informações básicas
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('isbn')->unique();

            // Conteúdo
            $table->text('description')->nullable();
            $table->longText('synopsis')->nullable();

            //Preços
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();

            // Estoque
            $table->unsignedInteger('stock')->default(0);

            // Informações do livro
            $table->unsignedSmallInteger('pages')->nullable();
            $table->string('language')->default('Português');
            $table->string('edition')->nullable();
            $table->string('format')->default('Capa comum');

            $table->date('publication_date')->nullable();

            // Frete
            $table->decimal('weight', 8, 3)->default(0);
            $table->decimal('height', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('length', 8, 2)->nullable();

            // Editora
            $table->foreignId('publisher_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Índices para busca
            $table->index('title');
            $table->index('stock');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
