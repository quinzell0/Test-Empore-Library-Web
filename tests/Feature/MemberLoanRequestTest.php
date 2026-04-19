<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MemberLoanRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_member_can_submit_loan_request(): void
    {
        $member = Member::query()->create([
            'member_code' => 'AGT100',
            'name' => 'Member Test',
            'email' => 'member@test.local',
            'password' => 'password',
        ]);

        $book = Book::query()->create([
            'code' => 'BK100',
            'title' => 'Laravel Testing',
            'publish_year' => 2025,
            'author' => 'QA Team',
            'stock' => 2,
        ]);

        $response = $this->actingAs($member, 'member')->post('/member/loan-requests', [
            'book_id' => $book->id,
            'loan_date' => now()->addDay()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
            'notes' => 'Mohon diproses.',
        ]);

        $response->assertRedirect(route('member.dashboard'));

        $this->assertDatabaseHas('book_loans', [
            'member_id' => $member->id,
            'book_id' => $book->id,
            'status' => 'pending',
            'notes' => 'Mohon diproses.',
        ]);
    }
}
