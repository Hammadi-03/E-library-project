<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')
          ->constrained()
          ->onDelete('cascade');                 // User who borrowed the book

    $table->foreignId('book_id')
          ->constrained()
          ->onDelete('cascade');                 // Borrowed book

    $table->date('borrow_date');                 // Date when the book was borrowed
    $table->date('due_date');                    // Return deadline
    $table->date('returned_date')
          ->nullable();                          // Actual return date

    $table->enum('status', ['borrowed', 'returned', 'overdue'])
          ->default('borrowed');                 // Current loan status

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
