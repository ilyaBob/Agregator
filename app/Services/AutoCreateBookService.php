<?php

namespace App\Services;

use App\Models\Admin\Book;
use App\Services\Parsing\AudioknigaOnline;
use App\Services\Parsing\Fantworld;
use simplehtmldom\HtmlWeb;

class AutoCreateBookService
{
    public function store($url)
    {
        $parsedUrl = parse_url($url);

        switch ($parsedUrl['host']) {
            case 'audiokniga-online.ru':
                return (new AudioknigaOnline())->findData($url);

            case 'fantbook.org':
                return (new Fantworld())->findData($url);
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

    public function filterStore(array $urls)
    {
        foreach ($urls as $url) {
            $dataUrl = $this->store($url);

            if (!$dataUrl) {
                continue;
            }

            $this->create($dataUrl);
        }
    }

    public function findUrls(string $url){

        $client = new HtmlWeb();
        $html = $client->load($url);

        $list = $html->find('.sect__content>.poster');

        $data = [];

        foreach ($list as $item){
            $data[] = $item->attr['href'];
        }

        $this->filterStore($data);
    }
}
