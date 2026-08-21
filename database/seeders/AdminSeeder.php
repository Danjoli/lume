<?php

namespace Database\Seeders;

use App\Enums\AdminRole;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@lume.test',
            'role' => AdminRole::SUPERADMIN,
            'password' => Hash::make('Lume@2026!Admin'),
        ]);

        Admin::factory()->count(5)->create(['password' => Hash::make('Lume@2026!Admin')]);
    }
}
