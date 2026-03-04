<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'description',
        'cover_image',
        'Category',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // One book can be loaned many times (One-to-Many)
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    // Check if book is currently available (not borrowed)
    public function isAvailable()
    {
        return !$this->loans()
            ->where('status', 'borrowed')
            ->whereNull('returned_date')
            ->exists();
    }
}
