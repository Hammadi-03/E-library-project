<?php

namespace App\Notifications;

use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OverdueBookNotification extends Notification
{
    use Queueable;

    protected $loan;

    /**
     * Create a new notification instance.
     */
    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'loan_id' => $this->loan->id,
            'book_id' => $this->loan->book->id,
            'book_title' => $this->loan->book->title,
            'due_date' => $this->loan->due_date ? $this->loan->due_date->format('d M Y') : 'N/A',
            'message' => \__('app.overdue_warning', [
                'title' => $this->loan->book->title,
                'due'   => $this->loan->due_date ? $this->loan->due_date->format('d M Y') : 'N/A',
            ]),
        ];
    }
}
