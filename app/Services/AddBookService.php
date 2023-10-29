<?php

namespace App\Services;

use App\Models\Admin\Author;
use App\Models\Admin\Book;
use App\Models\Admin\Cycle;
use App\Models\Admin\File;
use App\Models\Admin\Genre;
use App\Models\Admin\Reader;
use Exception;
use Illuminate\Support\Facades\DB;
use simplehtmldom\HtmlWeb;

class AddBookService
{
    public function store($url)
    {
        $parsedUrl = parse_url($url);
        $domain = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];

        DB::beginTransaction();

        try {
            $client = new HtmlWeb();
            $html = $client->load($url);

            $title = $html->find('h1', 0)->plaintext;
            $id = Book::where('title', $title)->first();

            if (!empty($id)) {
                return null;
            }

            $list = $html->find('.pmovie__header-list>li');
            $description = $html->find('.full-text', 0)->plaintext;
            $image = $html->find('.pmovie__poster img', 0)->getAttribute('data-src');

            $res = [];

            foreach ($list as $item) {
                preg_match("/Год:|Автор:|Читает:|Время|Цикл:|Жанр:/", $item->plaintext, $match);
                $val = str_replace($match[0], "", $item->plaintext);
                $key = str_replace(":", "", $match[0]);

                switch ($key) {
                    case 'Жанр':
                        $res['genres'] = $this->getGenres($val);
                        $res['genre_slug'] = $this->getGenreSlug($val);
                        break;

                    case 'Цикл':
                        $res["cycle_number"] = $this->getCycle($val);
                        $res["cycle_id"] = $this->getCycleNumber($val);
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
            $res["image"] = $domain.$image;
            $res['files'] = $this->getFiles($html);
            $res['link_to_original'] = $url;
            $res['is_active'] = '1';

            DB::commit();

            return $res;

        } catch (Exception $e) {
            DB::rollback();
            abort(404);
        }
    }

    public function getGenres($val)
    {
        $arrGenre = explode("/", $val);
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

    public function getGenreSlug($val)
    {
        $arrGenre = explode("/", $val);
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

    public function getCycle($val)
    {
        preg_match("/№[1-9][1-9]|№[1-9]|[1-9][1-9]|[1-9]/", $val, $match);
        return str_replace("№", "", $match[0]);
    }

    public function getCycleNumber($val)
    {
        preg_match("/№[1-9][1-9]|№[1-9]|[1-9][1-9]|[1-9]/", $val, $match);
        $cycleName = trim(str_replace($match[0], "", $val));

        $cycle = Cycle::firstOrCreate([
            'name' => $cycleName
        ], [
            'name' => $cycleName,
            'slug' => TransliterationService::generateSlug($cycleName),
            'is_active' => '1'
        ]);

        return $cycle->id;
    }

    public function getAuthors($val)
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

    public function getReaders($val)
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

    public function getAge($val)
    {
        preg_match("/\d+/", $val, $matches);
        return $matches[0];
    }

    public function getTime($val)
    {
        preg_match("/\d{2}:\d{2}:\d{2}/", $val, $matches);
        return $matches[0];
    }

    public function getFiles($html)
    {
        // поиск файлов
        $scripts = $html->find('[text/javascript]');

        $arr = []; // Массив всех скриптов с сайта
        foreach ($scripts as $item) {
            array_push($arr, $item);
        }
        $strArr = implode($arr);

        preg_match_all('/"title":"(\d+)","file":"[^"]+"/', $strArr, $match);
        $files = []; // Готовый массив с файлами

        $count = 1;
        foreach ($match[0] as $file) {
            $file = explode('"', $file);

            $fileItem = File::firstOrCreate([
                'file' => $file
            ], [
                'file' => $file[7],
                'title' => $count
            ]);

            $files[] = $fileItem->id;
            $count++;
        }


        return $files;
    }
}
