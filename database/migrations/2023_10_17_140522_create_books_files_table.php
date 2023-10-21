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
        Schema::create('books_files', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('file_id');

            $table->index('book_id', 'books_files_book_idx');
            $table->index('file_id', 'books_files_file_idx');

            $table->foreign('book_id', 'books_files_book_fk')->references('id')->on('books');
            $table->foreign('file_id', 'books_files_file_fk')->references('id')->on('files');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_files');
    }
};
