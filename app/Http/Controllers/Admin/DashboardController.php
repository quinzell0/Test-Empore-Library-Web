<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookLoan;
use App\Models\Member;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'bookCount' => Book::count(),
            'memberCount' => Member::count(),
            'pendingRequestCount' => BookLoan::where('status', 'pending')->count(),
        ]);
    }
}
