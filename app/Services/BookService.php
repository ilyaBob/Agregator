<?php

namespace App\Services;

use App\Models\Admin\Book;

class BookService
{
    public static function store($data)
    {
        $data['slug'] = TransliterationService::generateSlug($data['title']);

        $authors = $data['authors'];
        $readers = $data['readers'];
        $genres = $data['genres'];

        unset($data['authors']);
        unset($data['readers']);
        unset($data['genres']);

        $book = Book::create($data);
        $book->authors()->attach($authors);
        $book->readers()->attach($readers);
        $book->genres()->attach($genres);

        return null;
    }
}
