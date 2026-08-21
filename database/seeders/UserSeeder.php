<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('Lume@2026!Demo'),
        ]);

        // Usuários adicionais para testes
        User::factory()
            ->count(60)
            ->create([
                'status' => UserStatus::ACTIVE,
            ]);
    }
}
