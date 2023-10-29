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

        if (!isset($data['cycle_number'])) {
            unset($data['cycle_number']);
            unset($data['cycle_id']);
        }

        $book = Book::create($data);
        $book->authors()->attach($authors);
        $book->readers()->attach($readers);
        $book->genres()->attach($genres);

        return null;
    }

    public static function update($id, $data): void
    {
        if (!key_exists('is_active', $data)) {
            $data['is_active'] = 0;
        }

        $authors = $data['authors'];
        $readers = $data['readers'];
        $genres = $data['genres'];

        unset($data['authors']);
        unset($data['readers']);
        unset($data['genres']);

        if ( !isset($data['cycle_number']) ) {
            $data['cycle_number'] = null;
            $data['cycle_id'] = null;
        }

        $id->update($data);
        $id->authors()->sync($authors);
        $id->readers()->sync($readers);
        $id->genres()->sync($genres);
    }
}
