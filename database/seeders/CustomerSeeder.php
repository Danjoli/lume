<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
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

            $cart = Cart::factory()
                ->create([
                    'user_id' => $user->id,
                ]);

            if (fake()->boolean(65)) {
                $books->random(rand(1, 5))->each(fn ($book) => CartItem::factory()->create([
                    'cart_id' => $cart->id,
                    'book_id' => $book->id,
                    'quantity' => rand(1, 3),
                    'unit_price' => $book->sale_price ?? $book->price,
                ]));
            }

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
