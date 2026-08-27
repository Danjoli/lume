<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Editoras
        |--------------------------------------------------------------------------
        */

        $publishers = Publisher::factory()
            ->count(10)
            ->create();

        /*
        |--------------------------------------------------------------------------
        | Autores
        |--------------------------------------------------------------------------
        */

        $authors = Author::factory()
            ->count(35)
            ->create();

        /*
        |--------------------------------------------------------------------------
        | Categorias
        |--------------------------------------------------------------------------
        */

        $categories = Category::factory()
            ->count(18)
            ->create();

        /*
        |--------------------------------------------------------------------------
        | Livros
        |--------------------------------------------------------------------------
        */

        $books = Book::factory()
            ->count(100)
            ->state(fn () => [
                'publisher_id' => $publishers->random()->id,
            ])
            ->create();

        /*
        |--------------------------------------------------------------------------
        | Relacionamentos dos livros
        |--------------------------------------------------------------------------
        */

        foreach ($books as $book) {

            // Cada livro recebe 1 a 3 autores
            $book->authors()->attach(
                $authors->random(rand(1, 3))
            );

            // Cada livro recebe 1 a 3 categorias
            $book->categories()->attach(
                $categories->random(rand(1, 3))
            );

            /*
            |--------------------------------------------------------------------------
            | Imagens
            |--------------------------------------------------------------------------
            */

            BookImage::factory()
                ->primary()
                ->create([
                    'book_id' => $book->id,
                ]);

            BookImage::factory()
                ->count(fake()->numberBetween(0, 3))
                ->create([
                    'book_id' => $book->id,
                ]);
        }
    }
}
