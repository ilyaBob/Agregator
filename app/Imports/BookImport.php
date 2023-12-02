<?php

namespace App\Imports;

use App\Enums\NotificationEnum;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Requests\StoreBookRequest;
use App\Jobs\BookImportJob;
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

            BookImportJob::dispatch($row);
        }
    }
}
