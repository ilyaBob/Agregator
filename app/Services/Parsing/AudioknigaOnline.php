<?php

namespace App\Services\Parsing;

use App\Enums\NotificationEnum;
use App\Http\Controllers\Admin\NotificationController;
use App\Models\Admin\Book;
use App\Models\Admin\File;
use App\Services\BookService;
use App\Services\TransliterationService;
use Exception;
use Illuminate\Support\Facades\DB;
use simplehtmldom\HtmlWeb;

class AudioknigaOnline
{
    public $domain = null;
    public $url = null;

    public function findData($url)
    {
        $this->url = $url;
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

            $res['genres'] = null;
            $res['genre_slug'] = null;
            $res["cycle_number"] = null;
            $res["cycle_id"] = null;
            $res['authors'] = null;
            $res['readers'] = null;
            $res['age'] = null;
            $res['time'] = null;

            foreach ($list as $item) {
                preg_match("/Год:|Автор:|Читает:|Время|Цикл|Жанр:/", $item->plaintext, $match);

                if (empty($match)) {
                    continue;
                }

                $val = str_replace($match[0], "", $item->plaintext);
                $key = str_replace(":", "", $match[0]);

                switch ($key) {
                    case 'Жанр':
                        $res['genres'] = BookService::getOrCreateGenre($val);
                        $res['genre_slug'] = BookService::getGenreSlug($res['genres'][0]);

                        break;
                    case 'Цикл':
                        $res["cycle_number"] = BookService::getCycleNumber($val);
                        $res["cycle_id"] = BookService::getOrCreateCycle($val);
                        break;

                    case 'Автор':
                        $res['authors'] = BookService::getOrCreateAuthors($val);
                        break;

                    case 'Читает':
                        $res['readers'] = BookService::getOrCreateReaders($val);
                        break;

                    case 'Год':
                        $res['age'] = BookService::getAge($val);
                        break;

                    case 'Время':
                        $res['time'] = BookService::getTime($val);
                        break;

                    default:
                        $res[$key] = $val;
                        break;
                }
            }

            $res["description"] = $description;
            $res["title"] = $title;
            $res["slug"] = TransliterationService::generateSlug($title);
            $res["image"] = $this->domain . $image;
            $res['files'] = $this->getFiles($html);
            $res['link_to_original'] = $url;
            $res['is_active'] = '1';

            foreach ($res as $key => $attribute){
                if(empty($attribute) && ($key != 'cycle_number' && $key != 'age')){
                    throw new Exception("Не найдено $key". $this->getMessageUrl($url));
                }
            }

            DB::commit();

            return $res;

        } catch (Exception $e) {
            DB::rollback();
            NotificationController::create('Критическая ошибка', $e->getMessage(), NotificationEnum::TYPE_ERROR);
            return false;
        }
    }

    /**
     * @throws Exception
     */
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

        if(empty($match[0][0])){
            throw new Exception("Не найдено файлов". $this->getMessageUrl($this->url));
        }

        $fileLinkStorage = explode('"', $match[0][0]);
        $fileLinkStorage = $this->domain . $fileLinkStorage[1];

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

    protected function getMessageUrl($url): string
    {
        return " (Ссылка: $url)";
    }
}
