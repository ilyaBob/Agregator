<?php

namespace App\Services;

use App\Models\Admin\Book;
use App\Services\Parsing\AudioknigaOnline;

class AutoCreateBookService
{
    public function store($url)
    {
        $parsedUrl = parse_url($url);

        switch ($parsedUrl['host']) {
            case 'audiokniga-online.ru':
                $audioknigaOnline = new AudioknigaOnline();
                return $audioknigaOnline->findData($url);

                break;
            case 'fantbook.org':
                /*
                return Fantworld::findData($url);
                break;
                */
        }
        return abort(404);
    }

    public function create($res)
    {
        $authors = $res['authors'];
        $readers = $res['readers'];
        $genres = $res['genres'];
        $files = $res['files'];

        unset($res['authors']);
        unset($res['readers']);
        unset($res['genres']);
        unset($res['files']);

        $book = Book::create($res);

        $book->authors()->attach($authors);
        $book->readers()->attach($readers);
        $book->genres()->attach($genres);
        $book->files()->attach($files);
    }
}
