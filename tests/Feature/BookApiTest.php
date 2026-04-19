<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_books_api_supports_crud_by_code(): void
    {
        $createResponse = $this->postJson('/api/books', [
            'code' => 'API001',
            'title' => 'API Test Book',
            'publish_year' => 2025,
            'author' => 'Tester',
            'stock' => 7,
        ]);

        $createResponse
            ->assertCreated()
            ->assertJsonPath('data.code', 'API001');

        $this->getJson('/api/books')
            ->assertOk()
            ->assertJsonPath('data.0.code', 'API001');

        $this->getJson('/api/books/API001')
            ->assertOk()
            ->assertJsonPath('data.title', 'API Test Book');

        $this->putJson('/api/books/API001', [
            'code' => 'API001',
            'title' => 'API Test Book Updated',
            'publish_year' => 2026,
            'author' => 'Tester',
            'stock' => 9,
        ])->assertOk()->assertJsonPath('data.stock', 9);

        $this->deleteJson('/api/books/API001')
            ->assertOk();

        $this->assertDatabaseMissing('books', [
            'code' => 'API001',
        ]);
    }

    public function test_book_api_prevents_duplicate_code(): void
    {
        Book::query()->create([
            'code' => 'BK001',
            'title' => 'Existing Book',
            'publish_year' => 2024,
            'author' => 'Existing Author',
            'stock' => 3,
        ]);

        $this->postJson('/api/books', [
            'code' => 'BK001',
            'title' => 'Another Book',
            'publish_year' => 2025,
            'author' => 'Tester',
            'stock' => 1,
        ])->assertStatus(422);
    }
}
