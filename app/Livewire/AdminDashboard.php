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

        // Calculate loan activity trends (last 7 days)
        $days = collect([6, 5, 4, 3, 2, 1, 0])->map(function ($d) {
            $date = now()->subDays($d);
            return [
                'name' => $date->format('D'), // Mon, Tue...
                'value' => Loan::whereDate('created_at', $date->toDateString())->count()
            ];
        });

        return view('admin-dashboard', compact('stats', 'recentLoans', 'recentUsers', 'overdueLoans', 'days'));
    }
}
