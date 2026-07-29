<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuário de teste principal
        User::factory()->create([
            'name' => 'Cliente Teste',
            'email' => 'cliente@lume.test',
            'status' => UserStatus::ACTIVE,
        ]);


        // Usuários adicionais para testes
        User::factory()
            ->count(20)
            ->create([
                'status' => UserStatus::ACTIVE,
            ]);
    }
}
