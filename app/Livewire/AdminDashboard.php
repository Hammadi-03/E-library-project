<?php

namespace App\Livewire;

use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class AdminDashboard extends Component
{
    public function render()
    {
        // Auto-check for overdue loans and notify users
        Loan::checkAndNotifyOverdue();

        $stats = [
            'total_books'    => Book::count(),
            'total_users'    => User::where('role', '!=', 'admin')->count(),
            'active_loans'   => Loan::where('status', 'borrowed')->count(),
            'overdue_loans'  => Loan::where('status', 'overdue')->count(),
            'returned_loans' => Loan::where('status', 'returned')->count(),
            'total_loans'    => Loan::count(),
        ];

        // Fetch records for dashboard lists
        $recentLoans  = Loan::with(['user', 'book'])->latest()->take(5)->get();
        $recentUsers  = User::where('role', '!=', 'admin')->latest()->take(4)->get();
        $overdueLoans = Loan::with(['user', 'book'])->where('status', 'overdue')->latest()->take(1)->get();

        return view('admin-dashboard', compact('stats', 'recentLoans', 'recentUsers', 'overdueLoans'));
    }
}
