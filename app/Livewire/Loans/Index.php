<?php

namespace App\Livewire\Loans;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;    
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showModal = false;
    
    // Form properties
    public ?int $user_id = null;
    public ?int $book_id = null;
    public string $borrow_date = '';
    public string $due_date = '';

    protected function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:borrow_date',
        ];
    }

    public function mount()
    {
        $this->borrow_date = now()->format('Y-m-d');
        $this->due_date = now()->addDays(7)->format('Y-m-d');
    }

    public function openModal()
    {
        $this->reset(['user_id', 'book_id']);
        $this->borrow_date = now()->format('Y-m-d');
        $this->due_date = now()->addDays(7)->format('Y-m-d');
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        Loan::create([
            'user_id' => $this->user_id,
            'book_id' => $this->book_id,
            'borrow_date' => $this->borrow_date,
            'due_date' => $this->due_date,
            'status' => 'borrowed',
        ]);

        session()->flash('message', __('app.msg_loan_recorded'));
        $this->showModal = false;
    }

    public function render()
    {
        $loans = Loan::with(['user', 'book'])
            ->when($this->search, function($q) {
                $q->whereHas('user', fn($query) => $query->where('name', 'like', "%{$this->search}%"))
                  ->orWhereHas('book', fn($query) => $query->where('title', 'like', "%{$this->search}%"));
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $users = User::all();
        $books = Book::all(); 

        return view('livewire.loans.index', [
            'loans' => $loans,
            'users' => $users,
            'books' => $books,
        ])->layout('layouts.app');
    }
}
