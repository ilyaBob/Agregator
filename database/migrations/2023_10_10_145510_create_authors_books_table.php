<?php

use App\Models\Admin\Author;
use App\Models\Admin\Book;
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
        Schema::create('authors_books', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('book_id');

            $table->index('author_id', 'authors_books_author_idx');
            $table->index('book_id', 'authors_books_book_idx');

            $table->foreign('author_id', 'authors_books_author_fk')->references('id')->on('authors');
            $table->foreign('book_id', 'authors_books_book_fk')->references('id')->on('books');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors_books');
    }
};
