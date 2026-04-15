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
        'google_books_id',
        'cover_url',
        'rating',
        'external_link',
        'source',
    ];

    // Returns the best available cover (local image takes priority, falls back to external URL)
    public function getCoverAttribute(): ?string
    {
        if ($this->cover_image) {
            return asset('images/books/' . $this->cover_image);
        }
        return $this->cover_url;
    }

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
