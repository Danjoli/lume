<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::firstOrCreate(
            ['id' => 1],
            [
                'store_name' => 'Lume',

                'email' => 'contato@lume.com',

                'currency' => 'BRL',
            ]
        );
    }
}
