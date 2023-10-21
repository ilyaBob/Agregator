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
        Schema::create('books_readers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('reader_id');

            $table->index('book_id', 'books_readers_book_idx');
            $table->index('reader_id', 'books_readers_reader_idx');

            $table->foreign('book_id', 'books_readers_book_fk')->references('id')->on('books');
            $table->foreign('reader_id', 'books_readers_reader_fk')->references('id')->on('readers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_readers');
    }
};
