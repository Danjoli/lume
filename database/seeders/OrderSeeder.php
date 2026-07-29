<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $books = Book::all();


        foreach ($users->random(10) as $user) {

            /*
            |--------------------------------------------------------------------------
            | Pedido
            |--------------------------------------------------------------------------
            */

            $order = Order::factory()
                ->create([
                    'user_id' => $user->id,
                ]);


            /*
            |--------------------------------------------------------------------------
            | Itens do pedido
            |--------------------------------------------------------------------------
            */

            OrderItem::factory()
                ->count(rand(1, 5))
                ->create([
                    'order_id' => $order->id,
                    'book_id' => $books->random()->id,
                ]);


            /*
            |--------------------------------------------------------------------------
            | Envio
            |--------------------------------------------------------------------------
            */

            Shipment::factory()
                ->create([
                    'order_id' => $order->id,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Avaliações
        |--------------------------------------------------------------------------
        */

        $users = User::all();
        $books = Book::all();

        foreach ($users as $user) {

            $books
                ->random(3)
                ->each(function ($book) use ($user) {

                    Review::factory()->create([
                        'user_id' => $user->id,
                        'book_id' => $book->id,
                    ]);

                });

        }
    }
}
