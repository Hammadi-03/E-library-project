<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\OverdueBookNotification;

class Loan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'book_id',
        'user_id',
        'borrow_date',
        'due_date',
        'returned_date',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'returned_date' => 'date',
    ];

    // THIS BOOK LOANED BY WHO (Many)
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // this is use for one user can borrow many books (One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // CHECK IF THE BOOK IS OVERDUE
    public function isOverdue()
    {
        return $this->status === 'overdue' && $this->returned_date === null && $this->due_date < now();
    }

    /**
     * Check for all overdue loans and send notifications.
     */
    public static function checkAndNotifyOverdue()
    {
        $overdueLoans = self::where('status', 'borrowed')
            ->where('due_date', '<', now())
            ->whereNull('returned_date')
            ->get();

        foreach ($overdueLoans as $loan) {
            // Update status to overdue
            $loan->update(['status' => 'overdue']);

            // Send notification to the user who borrowed the book
            if ($loan->user) {
                $loan->user->notify(new OverdueBookNotification($loan));
            }
        }
    }
}
