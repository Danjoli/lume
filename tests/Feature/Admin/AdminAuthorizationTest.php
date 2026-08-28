<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_support_can_view_books_but_cannot_create_or_update_them(): void
    {
        $support = Admin::factory()->support()->create();
        $book = Book::factory()->create();

        $this->actingAs($support, 'admin')
            ->get(route('admin.books.index'))
            ->assertOk();

        $this->get(route('admin.books.create'))
            ->assertForbidden();

        $this->get(route('admin.books.edit', $book))
            ->assertForbidden();
    }

    public function test_administrator_can_manage_books_but_cannot_delete_them(): void
    {
        $administrator = Admin::factory()->admin()->create();
        $book = Book::factory()->create();

        $this->actingAs($administrator, 'admin')
            ->get(route('admin.books.create'))
            ->assertOk();

        $this->delete(route('admin.books.destroy', $book))
            ->assertForbidden();
    }

    public function test_only_super_administrator_can_manage_administrators(): void
    {
        $administrator = Admin::factory()->admin()->create();
        $superAdmin = Admin::factory()->superAdmin()->create();

        $this->actingAs($administrator, 'admin')
            ->get(route('admin.admins.index'))
            ->assertOk();

        $this->get(route('admin.admins.create'))
            ->assertForbidden();

        $this->actingAs($superAdmin, 'admin')
            ->get(route('admin.admins.create'))
            ->assertOk();
    }
}
