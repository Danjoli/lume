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
            ->count(5)
            ->create();


        /*
        |--------------------------------------------------------------------------
        | Autores
        |--------------------------------------------------------------------------
        */

        $authors = Author::factory()
            ->count(15)
            ->create();


        /*
        |--------------------------------------------------------------------------
        | Categorias
        |--------------------------------------------------------------------------
        */

        $categories = Category::factory()
            ->count(10)
            ->create();


        /*
        |--------------------------------------------------------------------------
        | Livros
        |--------------------------------------------------------------------------
        */

        $books = Book::factory()
            ->count(50)
            ->create([
                'publisher_id' => $publishers->random()->id,
            ]);


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
                ->count(rand(1, 4))
                ->create([
                    'book_id' => $book->id,
                ]);
        }
    }
}
