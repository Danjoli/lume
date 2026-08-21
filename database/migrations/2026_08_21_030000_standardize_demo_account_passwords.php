<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->update(['password' => Hash::make('Lume@2026!Demo')]);
        DB::table('admins')->update(['password' => Hash::make('Lume@2026!Admin')]);
    }

    public function down(): void
    {
        // Senhas anteriores não podem ser recuperadas por serem hashes unidirecionais.
    }
};
