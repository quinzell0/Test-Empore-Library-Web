<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LoanRequestController as AdminLoanRequestController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\MemberAuthController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\LoanController as MemberLoanController;
use App\Http\Controllers\Member\LoanRequestController as MemberLoanRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.select-login');
})->name('login.selector');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::middleware('guest:admin')->group(function (): void {
        Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth:admin')->group(function (): void {
        Route::post('/logout', [AdminAuthController::class, 'destroy'])->name('logout');
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard');

        Route::get('/books/data', [AdminBookController::class, 'data'])->name('books.data');
        Route::resource('books', AdminBookController::class)->except('show');

        Route::get('/members/data', [AdminMemberController::class, 'data'])->name('members.data');
        Route::resource('members', AdminMemberController::class)->except('show');

        Route::get('/loan-requests/data', [AdminLoanRequestController::class, 'data'])->name('loan-requests.data');
        Route::get('/loan-requests', [AdminLoanRequestController::class, 'index'])->name('loan-requests.index');
        Route::patch('/loan-requests/{loan}/status', [AdminLoanRequestController::class, 'updateStatus'])->name('loan-requests.update-status');
        Route::get('/loans/data', [AdminLoanRequestController::class, 'loansData'])->name('loans.data');
        Route::get('/loans', [AdminLoanRequestController::class, 'loans'])->name('loans.index');
        Route::patch('/loans/{loan}/returned', [AdminLoanRequestController::class, 'markReturned'])->name('loans.return');
    });
});

Route::prefix('member')->name('member.')->group(function (): void {
    Route::middleware('guest:member')->group(function (): void {
        Route::get('/login', [MemberAuthController::class, 'create'])->name('login');
        Route::post('/login', [MemberAuthController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth:member')->group(function (): void {
        Route::post('/logout', [MemberAuthController::class, 'destroy'])->name('logout');
        Route::get('/dashboard', MemberDashboardController::class)->name('dashboard');
        Route::get('/loans', [MemberLoanController::class, 'index'])->name('loans.index');
        Route::get('/loan-requests/create', [MemberLoanRequestController::class, 'create'])->name('loan-requests.create');
        Route::post('/loan-requests', [MemberLoanRequestController::class, 'store'])->name('loan-requests.store');
    });
});
