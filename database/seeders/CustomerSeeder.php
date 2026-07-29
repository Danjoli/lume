<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Book;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $books = Book::all();


        foreach ($users as $user) {

            /*
            |--------------------------------------------------------------------------
            | Endereços
            |--------------------------------------------------------------------------
            */

            Address::factory()
                ->count(rand(1, 3))
                ->create([
                    'user_id' => $user->id,
                ]);


            /*
            |--------------------------------------------------------------------------
            | Carrinho
            |--------------------------------------------------------------------------
            */

            Cart::factory()
                ->create([
                    'user_id' => $user->id,
                ]);


            /*
            |--------------------------------------------------------------------------
            | Wishlist
            |--------------------------------------------------------------------------
            */

            $user->wishlistBooks()->attach(
                $books->random(rand(2, 5))->pluck('id')
            );
        }
    }
}
