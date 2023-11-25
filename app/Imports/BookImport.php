<?php

namespace App\Imports;

use App\Enums\NotificationEnum;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Requests\StoreBookRequest;
use App\Models\Admin\Book;
use App\Rules\isCycle;
use App\Rules\IsCycleId;
use App\Services\BookService;
use App\Services\TransliterationService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $collection): void
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
                $validator = BookService::validate($row->toArray());

                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $errors = implode('<br>', $errors->all());
                    throw new Exception($errors);
                }

                $data['title'] = $row['title'];
                $data['description'] = $row['description'];
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

                BookService::store($data);

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                NotificationController::create('Критическая ошибка у книги "' . $row['title'] . '"', $e->getMessage(), NotificationEnum::TYPE_ERROR);
            }
        }
    }
}
