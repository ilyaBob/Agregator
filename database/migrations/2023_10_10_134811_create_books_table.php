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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug');
            $table->string('image');
            $table->text('description');
            $table->boolean('is_active')->default(false);
            $table->integer('age')->nullable();
            $table->string('time');
            $table->integer('cycle_number')->nullable();
            $table->string('genre_slug');
            $table->string('link_to_original');

            $table->unsignedBigInteger('cycle_id')->nullable();
            $table->index('cycle_id', 'books_cycle_idx');
            $table->foreign('cycle_id', 'books_cycle_fk')->references('id')->on('cycles');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
