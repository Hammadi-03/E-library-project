<?php

namespace App\Livewire\Returns;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Loan;
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function markAsReturned($loanId)
    {
        $loan = Loan::findOrFail($loanId);
        
        $loan->update([
            'returned_date' => now(),
            'status' => 'returned',
        ]);

        // Delete any related notifications for this loan
        if ($loan->user) {
            $loan->user->notifications()
                ->where('type', \App\Notifications\OverdueBookNotification::class)
                ->where('data->loan_id', $loan->id)
                ->delete();
        }

        session()->flash('message', __('app.msg_return_processed'));
    }

    public function render()
    {
        $borrowedBooks = Loan::with(['user', 'book'])
            ->whereIn('status', ['borrowed', 'overdue'])
            ->when($this->search, function($q) {
                $q->whereHas('user', fn($query) => $query->where('name', 'like', "%{$this->search}%"))
                  ->orWhereHas('book', fn($query) => $query->where('title', 'like', "%{$this->search}%")
                                                          ->orWhere('isbn', 'like', "%{$this->search}%"));
            })
            ->orderBy('due_date', 'asc')
            ->paginate(10);

        return view('livewire.returns.index', [
            'borrowedBooks' => $borrowedBooks,
        ])->layout('layouts.app');
    }
}
