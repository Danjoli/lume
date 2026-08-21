<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
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

        foreach ($users as $user) {

            /*
            |--------------------------------------------------------------------------
            | Pedido
            |--------------------------------------------------------------------------
            */

            foreach (range(1, rand(1, 6)) as $position) {
                $state = fake()->randomElement(['pending', 'paid', 'shipped', 'delivered', 'cancelled']);
                $factory = match ($state) {
                    'paid' => Order::factory()->paid(), 'shipped' => Order::factory()->shipped(),
                    'delivered' => Order::factory()->delivered(), 'cancelled' => Order::factory()->cancelled(),
                    default => Order::factory(),
                };
                $order = $factory->create(['user_id' => $user->id, 'gateway' => 'asaas']);

                /*
                |--------------------------------------------------------------------------
                | Itens do pedido
                |--------------------------------------------------------------------------
                */

                $subtotal = 0;
                foreach ($books->random(rand(1, 5)) as $book) {
                    $quantity = rand(1, 3);
                    $price = (float) ($book->sale_price ?? $book->price);
                    $subtotal += $price * $quantity;
                    OrderItem::factory()->create(['order_id' => $order->id, 'book_id' => $book->id, 'title' => $book->title, 'quantity' => $quantity, 'price' => $price]);
                }
                $shipping = (float) $order->shipping;
                $order->update(['subtotal' => $subtotal, 'total' => max(0, $subtotal + $shipping - (float) $order->discount)]);

                /*
                |--------------------------------------------------------------------------
                | Envio
                |--------------------------------------------------------------------------
                */

                Shipment::factory()->create(['order_id' => $order->id, 'status' => match ($order->status) {
                    OrderStatus::SHIPPED => 'shipped', OrderStatus::DELIVERED => 'delivered', OrderStatus::CANCELLED => 'cancelled',
                    OrderStatus::PROCESSING => 'preparing', default => 'pending',
                }]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Avaliações
        |--------------------------------------------------------------------------
        */

        $users = User::all();
        $books = Book::all();

        foreach ($users as $user) {

            $purchasedBooks = Book::query()->whereHas('orderItems.order', fn ($query) => $query->where('user_id', $user->id)->where('payment_status', PaymentStatus::PAID))->get();
            $purchasedBooks
                ->shuffle()->take(min(5, $purchasedBooks->count()))
                ->each(function ($book) use ($user) {

                    Review::updateOrCreate([
                        'user_id' => $user->id,
                        'book_id' => $book->id,
                    ], ['rating' => fake()->numberBetween(3, 5), 'comment' => fake()->paragraphs(2, true), 'is_approved' => fake()->boolean(85)]);

                });

        }
    }
}
