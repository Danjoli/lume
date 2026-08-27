<?php

namespace Tests\Unit\Models;

use App\Models\Book;
use Tests\TestCase;

class BookTest extends TestCase
{
    public function test_current_price_prefers_the_sale_price_when_available(): void
    {
        $book = new Book([
            'price' => 59.90,
            'sale_price' => 49.90,
        ]);

        $this->assertSame('49.90', $book->current_price);
        $this->assertTrue($book->isOnSale());
    }

    public function test_book_availability_requires_an_active_book_with_stock(): void
    {
        $availableBook = new Book(['is_active' => true, 'stock' => 1]);
        $inactiveBook = new Book(['is_active' => false, 'stock' => 1]);
        $outOfStockBook = new Book(['is_active' => true, 'stock' => 0]);

        $this->assertTrue($availableBook->isAvailable());
        $this->assertFalse($inactiveBook->isAvailable());
        $this->assertFalse($outOfStockBook->isAvailable());
    }
}
