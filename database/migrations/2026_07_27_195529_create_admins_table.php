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
        Schema::create('admins', function (Blueprint $table) {
            
            $table->id();

            // Dados pessoais
            $table->string('name');

            $table->string('email')
                ->unique();

            // Segurança
            $table->string('password');

            $table->rememberToken();

            // Permissões
            $table->string('role', 50)
                ->default('admin');

            // Controle
            $table->boolean('is_active')
                ->default(true);

            $table->timestamp('last_login_at')
                ->nullable();

            $table->timestamps();

            // Soft delete
            $table->softDeletes();


            // Índices
            $table->index('role');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
