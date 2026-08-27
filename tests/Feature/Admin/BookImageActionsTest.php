<?php

namespace Tests\Feature\Admin;

use App\Actions\Books\SetPrimaryBookImageAction;
use App\Actions\Books\UploadBookImagesAction;
use App\Models\Book;
use App\Models\BookImage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookImageActionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_uploading_images_uses_the_persisted_image_field_and_keeps_the_existing_primary_image(): void
    {
        Storage::fake('public');

        $book = Book::factory()->create();
        $primaryImage = BookImage::factory()->primary()->create(['book_id' => $book]);

        app(UploadBookImagesAction::class)->execute($book, [
            UploadedFile::fake()->image('cover-one.jpg'),
            UploadedFile::fake()->image('cover-two.png'),
        ]);

        $images = $book->images()->orderBy('sort_order')->get();

        $this->assertCount(3, $images);
        $this->assertSame($primaryImage->id, $images->firstWhere('is_primary', true)?->id);
        $this->assertSame([0, 1, 2], $images->pluck('sort_order')->all());
        $this->assertTrue($images->slice(1)->every(fn (BookImage $image) => filled($image->image)));

        Storage::disk('public')->assertExists($images[1]->image);
        Storage::disk('public')->assertExists($images[2]->image);
    }

    public function test_selecting_the_primary_image_is_limited_to_the_book(): void
    {
        $book = Book::factory()->create();
        $firstImage = BookImage::factory()->primary()->create(['book_id' => $book]);
        $secondImage = BookImage::factory()->create(['book_id' => $book]);
        $anotherBookImage = BookImage::factory()->create();

        $image = app(SetPrimaryBookImageAction::class)->execute($book, $secondImage->id);

        $this->assertSame($secondImage->id, $image->id);
        $this->assertDatabaseHas('book_images', ['id' => $firstImage->id, 'is_primary' => false]);
        $this->assertDatabaseHas('book_images', ['id' => $secondImage->id, 'is_primary' => true]);

        $this->expectException(ModelNotFoundException::class);

        app(SetPrimaryBookImageAction::class)->execute($book, $anotherBookImage->id);
    }
}
