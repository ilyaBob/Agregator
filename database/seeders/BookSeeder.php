<?php

namespace Database\Seeders;

use App\Models\Admin\Author;
use App\Models\Admin\Book;
use App\Models\Admin\File;
use App\Models\Admin\Genre;
use App\Models\Admin\Reader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::factory(15)->create();

        $authors = Author::getAuthors();
        $readers = Reader::getReaders();
        $genres = Genre::getGenres();
        $file = File::all();

        foreach ($books as $book) {
            $authorsArray = $authors->random(3)->pluck('id');
            $readersArray = $readers->random(3)->pluck('id');
            $genresArray = $genres->random(3)->pluck('id');
            $fileArray = $file->random(3)->pluck('id');

            $book->authors()->attach($authorsArray);
            $book->readers()->attach($readersArray);
            $book->genres()->attach($genresArray);
            $book->files()->attach($fileArray);
        }

    }
}
