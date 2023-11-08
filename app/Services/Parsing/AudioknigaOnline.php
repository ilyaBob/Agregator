<?php

namespace App\Services\Parsing;

use App\Models\Admin\Author;
use App\Models\Admin\Book;
use App\Models\Admin\Cycle;
use App\Models\Admin\File;
use App\Models\Admin\Genre;
use App\Models\Admin\Reader;
use App\Services\TransliterationService;
use Illuminate\Support\Facades\DB;
use simplehtmldom\HtmlWeb;

class AudioknigaOnline
{
    public $domain = null;
    public function findData($url){

        $client = new HtmlWeb();
        $html = $client->load($url);

        $parsedUrl = parse_url($url);

        $this->domain = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
        $title = $html->find('h1', 0)->plaintext;
        $id = Book::where('title', $title)->first();

        if (!empty($id)) {
            return null;
        }

        $list = $html->find('.short-list>li');
        $description = $html->find('.full-text', 0)->plaintext;
        $image = $html->find('.fimg img', 0)->getAttribute('data-src');

        DB::beginTransaction();

        try {
            $res = [];

            foreach ($list as $item) {
                preg_match("/Год:|Автор:|Читает:|Время|Цикл|Жанр:/", $item->plaintext, $match);

                if (empty($match)){
                    continue;
                }

                $val = str_replace($match[0], "", $item->plaintext);
                $key = str_replace(":", "", $match[0]);

                switch ($key) {
                    case 'Жанр':
                        $res['genres'] = $this->getGenres($val);
                        $res['genre_slug'] = $this->getGenreSlug($val);
                        break;

                    case 'Цикл':
                        $res["cycle_number"] = $this->getCycle($val);
                        $res["cycle_id"] = $this->getCycleName($val);
                        break;

                    case 'Автор':
                        $res['authors'] = $this->getAuthors($val);
                        break;

                    case 'Читает':
                        $res['readers'] = $this->getReaders($val);
                        break;

                    case 'Год':
                        $res['age'] = $this->getAge($val);
                        break;

                    case 'Время':
                        $res['time'] = $this->getTime($val);
                        break;

                    default:
                        $res[$key] = $val;
                        break;
                }
            }

            $res["description"] = $description;
            $res["title"] = $title;
            $res["slug"] = TransliterationService::generateSlug($title);
            $res["image"] = $this->domain.$image;
            $res['files'] = $this->getFiles($html);
            $res['link_to_original'] = $url;
            $res['is_active'] = '1';

            DB::commit();

            return $res;

        } catch (\Exception $e) {
            DB::rollback();
            abort(404);
        }
    }

    protected function getGenres($val)
    {
        $arrGenre = explode(",", $val);
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

    protected function getGenreSlug($val)
    {
        $arrGenre = explode(",", $val);
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

            return $genreItem->slug;
        }
    }

    protected function getCycle($val)
    {
        preg_match("/№[1-9][1-9]|№[1-9]|[1-9][1-9]|[1-9]/", $val, $match);
        return str_replace("№", "", $match[0]);
    }

    protected function getCycleName($val)
    {
        preg_match("/№[1-9][1-9]|№[1-9]|[1-9][1-9]|[1-9]/", $val, $match);
        $cycleName = trim(str_replace([$match[0], '»', '«' , '()' ], "", $val));

        $cycle = Cycle::firstOrCreate([
            'name' => $cycleName
        ], [
            'name' => $cycleName,
            'slug' => TransliterationService::generateSlug($cycleName),
            'is_active' => '1'
        ]);

        return $cycle->id;
    }

    protected function getAuthors($val)
    {
        $arrAuthor = explode(",", $val);
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

    protected function getReaders($val)
    {
        $arrReader = explode(",", $val);
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

    protected function getAge($val)
    {
        preg_match("/\d+/", $val, $matches);
        return $matches[0];
    }

    protected function getTime($val)
    {
        preg_match("/\d{2}:\d{2}:\d{2}/", $val, $matches);
        return $matches[0];
    }

    protected function getFiles($html)
    {
        //Обший поиск скриптов на странице
        $scripts = $html->find('[text/javascript]');

        $arr = []; // Массив всех скриптов с сайта
        foreach ($scripts as $item) {
            array_push($arr, $item);
        }
        $strArr = implode($arr);

        preg_match_all('/file:"[^"]+"/', $strArr, $match);

        $fileLinkStorage = explode('"', $match[0][0]);
        $fileLinkStorage = $this->domain.$fileLinkStorage[1];

        // Поиск файла с котором хранится информация. (Особенность сайта)
        $clientFile = new HtmlWeb();
        $fileStorage = $clientFile->load($fileLinkStorage);

        $scripts = $fileStorage->find('[text/javascript]');

        $arr = []; // Массив всех скриптов с сайта
        foreach ($scripts as $item) {
            array_push($arr, $item);
        }
        $strArr = implode($arr);

        preg_match_all('/"title":"[^"]+","file":"[^"]+"/', $strArr, $match);

        $files = []; // Готовый массив с файлами
        foreach ($match[0] as $key => $file) {
            $file = explode('"', $file);

            $fileItem = File::firstOrCreate([
                'file' => $file
            ], [
                'file' => $file[7],
                'title' => $key
            ]);

            $files[] = $fileItem->id;
        }


        return $files;
    }
}
