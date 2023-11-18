<?php

namespace App\Services;

use App\Models\Admin\Author;
use App\Models\Admin\Book;
use App\Models\Admin\Cycle;
use App\Models\Admin\Genre;
use App\Models\Admin\Reader;

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

        if (!isset($data['cycle_number'])) {
            $data['cycle_number'] = null;
            $data['cycle_id'] = null;
        }

        $id->update($data);
        $id->authors()->sync($authors);
        $id->readers()->sync($readers);
        $id->genres()->sync($genres);
    }

    /**
     * This function takes a string input in the format "val1,val2,val3" and returns an array of genre ids.
     *
     * @param string $string The input string containing genre names separated by commas
     * @return array  An array of genre ids
     */
    public static function getOrCreateGenre(string $string): array
    {
        $arrGenre = explode(",", $string);
        $arrGenreRes = [];

        foreach ($arrGenre as $genre) {
            $genre = trim($genre);

            $genreItem = Genre::firstOrCreate([
                'name' => $genre
            ], [
                'name' => $genre,
                'slug' => TransliterationService::generateSlug($genre),
                'is_active' => '1'
            ]);

            $arrGenreRes[] = $genreItem->id;
        }

        return $arrGenreRes;
    }

    /**
     * This function takes integer and returns genre slug
     *
     * @param integer $id The input string containing genre id
     * @return string
     */
    public static function getGenreSlug(int $id): string
    {
        $genre = Genre::find($id);
        return $genre->slug;

    }

    /**
     * This function takes a string input in the format "/\d{2}:\d{2}:\d{2}/" and returns a string input in the format "00:00:00" .
     *
     * @param string $string The input string containing time
     * @return string
     */
    public static function getTime(string $string): string
    {
        preg_match("/\d{2}:\d{2}:\d{2}/", $string, $matches);
        return $matches[0];
    }

    /**
     * This function takes a string input in the format "val1,val2,val3" and returns an array of author ids.
     *
     * @param string $string The input string containing author names separated by commas
     * @return array  An array of author ids
     */
    public static function getOrCreateAuthors(string $string): array
    {
        $arrAuthor = explode(",", $string);
        $arrAuthorRes = [];

        foreach ($arrAuthor as $author) {
            $author = trim($author);

            $authorItem = Author::firstOrCreate([
                'name' => $author
            ], [
                'name' => $author,
                'slug' => TransliterationService::generateSlug($author),
                'is_active' => '1'
            ]);

            $arrAuthorRes[] = $authorItem->id;
        }

        return $arrAuthorRes;
    }

    /**
     * This function takes a string input in the format "val1,val2,val3" and returns an array of reader ids.
     *
     * @param string $string The input string containing reader names separated by commas
     * @return array  An array of reader ids
     */
    public static function getOrCreateReaders(string $string): array
    {
        $arrReader = explode(",", $string);
        $arrReaderRes = [];

        foreach ($arrReader as $reader) {
            $reader = trim($reader);

            $readerItem = Reader::firstOrCreate([
                'name' => $reader
            ], [
                'name' => $reader,
                'slug' => TransliterationService::generateSlug($reader),
                'is_active' => '1'
            ]);

            $arrReaderRes[] = $readerItem->id;
        }
        return $arrReaderRes;
    }

    /**
     * This function takes a string input in the format "val" and returns a string input in the format "val"
     *
     * @param string $string The input string containing integer or string input in the format "№[1-9][1-9]|№[1-9]|[1-9][1-9]|[1-9]"
     */
    public static function getCycleNumber(string $string)
    {
        preg_match("/№[1-9][1-9]|№[1-9]|[1-9][1-9]|[1-9]/", $string, $match);

        if (!empty($match)) {
            return str_replace("№", "", $match[0]);
        }
        return 0;
    }

    /**
     * This function takes a string input in the format "val" and returns a string input in the format "val"
     *
     * @param string $string The input string containing cycle name
     * @return integer Cycle id
     */
    public static function getOrCreateCycle(string $string): int
    {

        preg_match("/№[1-9][1-9]|№[1-9]|[1-9][1-9]|[1-9]/", $string, $match);
        if($match){
            $cycleName = trim(str_replace([$match[0], '»', '«', '()'], "", $string));
        }else{
            $cycleName = trim(str_replace(['»', '«', '()'], "", $string));
        }

        $cycle = Cycle::firstOrCreate([
            'name' => $cycleName
        ], [
            'name' => $cycleName,
            'slug' => TransliterationService::generateSlug($cycleName),
            'is_active' => '1'
        ]);

        return $cycle->id;
    }

    /**
     * This function takes a string input in the format "val" and returns a string input in the format "val"
     *
     * @param string $string The input string containing age
     * @return integer
     */
    public static function getAge(string $string): int
    {
        preg_match("/\d+/", $string, $matches);

        if (!empty($matches)) {
            return $matches[0];
        }

        return false;
    }
}
