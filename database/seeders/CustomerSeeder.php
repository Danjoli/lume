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

            if (! $user->addresses()->exists()) {
                Address::factory()
                    ->default()
                    ->create([
                        'user_id' => $user->id,
                    ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Carrinho
            |--------------------------------------------------------------------------
            */

            $cart = Cart::firstOrCreate([
                'user_id' => $user->id,
            ]);

            if (fake()->boolean(65)) {
                $books->random(fake()->numberBetween(1, 5))
                    ->each(fn ($book) => CartItem::firstOrCreate(
                        [
                            'cart_id' => $cart->id,
                            'book_id' => $book->id,
                        ],
                        [
                            'quantity' => fake()->numberBetween(1, 3),
                            'unit_price' => $book->sale_price ?? $book->price,
                        ],
                    ));
            }

            /*
            |--------------------------------------------------------------------------
            | Wishlist
            |--------------------------------------------------------------------------
            */

            if (! $user->wishlistBooks()->exists()) {
                $user->wishlistBooks()->attach(
                    $books->random(fake()->numberBetween(2, 5))->pluck('id')
                );
            }
        }
    }
}
