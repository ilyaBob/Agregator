<?php

namespace App\Imports;

use App\Enums\NotificationEnum;
use App\Http\Controllers\Admin\NotificationController;
use App\Models\Admin\Book;
use App\Services\BookService;
use App\Services\TransliterationService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if (!isset($row['title'])) {
                continue;
            }

            $book = Book::query()->where('title', $row['title'])->first();

            if (isset($book)) {
                continue;
            }

            DB::beginTransaction();
            $data = [];

            try {
                $data['title'] = $row['title'];
                $data['description'] = $row['description'];
                $data['slug'] = TransliterationService::generateSlug($row['title']);
                $data['image'] = $row['image'];
                $data['files'] = BookService::getOrCreateFiles($row['files']);
                $data['link_to_original'] = $row['link_to_original'];
                $data['is_active'] = $row['is_active'];
                $data['genres'] = BookService::getOrCreateGenre($row['genres']);
                $data['genre_slug'] = BookService::getGenreSlug($data['genres'][0]);
                $data['cycle_number'] = BookService::getCycleNumber($row['cycle_number']);
                $data['cycle_id'] = BookService::getOrCreateCycle($row['cycle']);
                $data['authors'] = BookService::getOrCreateAuthors($row['authors']);
                $data['readers'] = BookService::getOrCreateReaders($row['readers']);
                $data['age'] = BookService::getAge($row['age']);
                $data['time'] = BookService::getTime($row['time']);

                foreach ($data as $key => $attribute) {
                    if (empty($attribute) && ($key != 'cycle_number' && $key != 'age'))  {
                        throw new Exception("Не найдено: $key" . BookService::getMessageUrl($data['link_to_original']));
                    }
                }

                BookService::store($data);

                DB::commit();
            } catch (\Exception $e) {
                NotificationController::create('Критическая ошибка', $e->getMessage(), NotificationEnum::TYPE_ERROR);
                DB::rollBack();
            }
        }
    }
}
