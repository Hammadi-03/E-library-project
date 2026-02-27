<?php

namespace App\Livewire;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_books'    => Book::count(),
            'total_users'    => User::where('role', '!=', 'admin')->count(),
            'active_loans'   => Loan::where('status', 'borrowed')->count(),
            'overdue_loans'  => Loan::where('status', 'overdue')->count(),
            'returned_loans' => Loan::where('status', 'returned')->count(),
            'total_loans'    => Loan::count(),
        ];

        // Recent loans with user & book relation
        $recentLoans = Loan::with(['user', 'book'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin-dashboard', compact('stats', 'recentLoans'));
    }
}
