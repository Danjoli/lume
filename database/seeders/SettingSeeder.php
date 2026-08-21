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
                'company_name' => 'Livraria Lume',
                'cnpj' => '11.444.777/0001-61',
                'email' => 'contato@lume.test',
                'phone' => '(11) 3333-4444',
                'cep' => '01001-000',
                'origin_cep' => '01001-000',
                'street' => 'Praça da Sé',
                'number' => '100',
                'neighborhood' => 'Sé',
                'city' => 'São Paulo',
                'state' => 'SP',
                'currency' => 'BRL',
            ]
        );
    }
}
