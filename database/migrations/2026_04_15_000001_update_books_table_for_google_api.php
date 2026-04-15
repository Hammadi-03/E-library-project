<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Make isbn nullable so Google Books (without ISBN) can be stored
            $table->string('isbn')->nullable()->change();

            // New columns for Google Books API integration
            $table->string('google_books_id')->nullable()->unique()->after('isbn');
            $table->string('cover_url')->nullable()->after('cover_image');
            $table->decimal('rating', 3, 1)->nullable()->after('cover_url');
            $table->string('external_link')->nullable()->after('rating');
            // 'local' = added by admin, 'google' = imported from Google Books API
            $table->string('source')->default('local')->after('external_link');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('isbn')->nullable(false)->change();
            $table->dropColumn(['google_books_id', 'cover_url', 'rating', 'external_link', 'source']);
        });
    }
};
