<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\Admin;
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

    public function test_admin_can_approve_loan_request_and_reduce_book_stock(): void
    {
        $admin = Admin::query()->create([
            'name' => 'Admin',
            'email' => 'admin@test.local',
            'password' => 'password',
        ]);

        $member = Member::query()->create([
            'member_code' => 'AGT101',
            'name' => 'Member Test',
            'email' => 'member2@test.local',
            'password' => 'password',
        ]);

        $book = Book::query()->create([
            'code' => 'BK101',
            'title' => 'Laravel Queue',
            'publish_year' => 2025,
            'author' => 'Backend Team',
            'stock' => 2,
        ]);

        $loan = BookLoan::query()->create([
            'member_id' => $member->id,
            'book_id' => $book->id,
            'loan_date' => now()->addDay()->toDateString(),
            'due_date' => now()->addDays(5)->toDateString(),
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin, 'admin')->patch(route('admin.loan-requests.update-status', $loan), [
            'status' => 'approved',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('book_loans', [
            'id' => $loan->id,
            'status' => 'approved',
            'processed_by_admin_id' => $admin->id,
        ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'stock' => 1,
        ]);
    }

    public function test_admin_can_reject_loan_request_without_changing_book_stock(): void
    {
        $admin = Admin::query()->create([
            'name' => 'Admin Reject',
            'email' => 'admin2@test.local',
            'password' => 'password',
        ]);

        $member = Member::query()->create([
            'member_code' => 'AGT105',
            'name' => 'Member Reject',
            'email' => 'member6@test.local',
            'password' => 'password',
        ]);

        $book = Book::query()->create([
            'code' => 'BK105',
            'title' => 'Laravel Policies',
            'publish_year' => 2025,
            'author' => 'Security Team',
            'stock' => 5,
        ]);

        $loan = BookLoan::query()->create([
            'member_id' => $member->id,
            'book_id' => $book->id,
            'loan_date' => now()->addDay()->toDateString(),
            'due_date' => now()->addDays(6)->toDateString(),
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin, 'admin')->patch(route('admin.loan-requests.update-status', $loan), [
            'status' => 'rejected',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('book_loans', [
            'id' => $loan->id,
            'status' => 'rejected',
            'processed_by_admin_id' => $admin->id,
        ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'stock' => 5,
        ]);
    }

    public function test_admin_can_mark_loan_as_returned_and_restore_book_stock(): void
    {
        $admin = Admin::query()->create([
            'name' => 'Admin',
            'email' => 'admin3@test.local',
            'password' => 'password',
        ]);

        $member = Member::query()->create([
            'member_code' => 'AGT102',
            'name' => 'Member Return',
            'email' => 'member3@test.local',
            'password' => 'password',
        ]);

        $book = Book::query()->create([
            'code' => 'BK102',
            'title' => 'Laravel Event',
            'publish_year' => 2025,
            'author' => 'Platform Team',
            'stock' => 0,
        ]);

        $loan = BookLoan::query()->create([
            'member_id' => $member->id,
            'book_id' => $book->id,
            'loan_date' => now()->subDays(3)->toDateString(),
            'due_date' => now()->addDay()->toDateString(),
            'status' => 'approved',
            'processed_by_admin_id' => $admin->id,
            'processed_at' => now(),
        ]);

        $response = $this->actingAs($admin, 'admin')->patch(route('admin.loans.return', $loan));

        $response->assertRedirect();

        $this->assertDatabaseHas('book_loans', [
            'id' => $loan->id,
            'status' => 'returned',
            'processed_by_admin_id' => $admin->id,
        ]);

        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'stock' => 1,
        ]);
    }

    public function test_member_can_view_only_their_own_loans(): void
    {
        $member = Member::query()->create([
            'member_code' => 'AGT103',
            'name' => 'Member History',
            'email' => 'member4@test.local',
            'password' => 'password',
        ]);

        $otherMember = Member::query()->create([
            'member_code' => 'AGT104',
            'name' => 'Other Member',
            'email' => 'member5@test.local',
            'password' => 'password',
        ]);

        $bookA = Book::query()->create([
            'code' => 'BK103',
            'title' => 'Laravel Horizon',
            'publish_year' => 2025,
            'author' => 'Ops Team',
            'stock' => 3,
        ]);

        $bookB = Book::query()->create([
            'code' => 'BK104',
            'title' => 'Laravel Echo',
            'publish_year' => 2025,
            'author' => 'Realtime Team',
            'stock' => 4,
        ]);

        BookLoan::query()->create([
            'member_id' => $member->id,
            'book_id' => $bookA->id,
            'loan_date' => now()->subDays(2)->toDateString(),
            'due_date' => now()->addDays(4)->toDateString(),
            'status' => 'approved',
        ]);

        BookLoan::query()->create([
            'member_id' => $otherMember->id,
            'book_id' => $bookB->id,
            'loan_date' => now()->subDay()->toDateString(),
            'due_date' => now()->addDays(6)->toDateString(),
            'status' => 'approved',
        ]);

        $response = $this->actingAs($member, 'member')->get(route('member.loans.index'));

        $response
            ->assertOk()
            ->assertSee('Laravel Horizon')
            ->assertDontSee('Laravel Echo');
    }
}
