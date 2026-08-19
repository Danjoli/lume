<?php

namespace App\Notifications\Books;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Book $book
    ) {
    }

    public function via(object $notifiable): array
    {
        return [
            'database',
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'low_stock',

            'title' => 'Estoque baixo',

            'message' => sprintf(
                '"%s" possui apenas %d unidade(s) em estoque.',
                $this->book->title,
                $this->book->stock
            ),

            'url' => route(
                'admin.books.edit',
                $this->book
            ),

            'book_id' => $this->book->id,
        ];
    }
}
