<?php

namespace App\Jobs;

use App\Enums\NotificationEnum;
use App\Http\Controllers\Admin\NotificationController;
use App\Services\BookService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class BookImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $row;

    /**
     * Create a new job instance.
     */
    public function __construct($row)
    {
        //
        $this->row = $row;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();
        $data = [];

        try {
            $validator = BookService::validate($this->row->toArray());

            if ($validator->fails()) {
                $errors = $validator->errors();
                $errors = implode('<br>', $errors->all());
                throw new Exception($errors);
            }

            $data['title'] = $this->row['title'];
            $data['description'] = $this->row['description'];
            $data['image'] = $this->row['image'];
            $data['files'] = BookService::getOrCreateFiles($this->row['files']);
            $data['link_to_original'] = $this->row['link_to_original'];
            $data['is_active'] = $this->row['is_active'];
            $data['genres'] = BookService::getOrCreateGenre($this->row['genres']);
            $data['genre_slug'] = BookService::getGenreSlug($data['genres'][0]);
            $data['cycle_number'] = BookService::getCycleNumber($this->row['cycle_number']);
            $data['cycle_id'] = BookService::getOrCreateCycle($this->row['cycle']);
            $data['authors'] = BookService::getOrCreateAuthors($this->row['authors']);
            $data['readers'] = BookService::getOrCreateReaders($this->row['readers']);
            $data['age'] = BookService::getAge($this->row['age']);
            $data['time'] = BookService::getTime($this->row['time']);

            BookService::store($data);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            NotificationController::create('Критическая ошибка у книги "' . $this->row['title'] . '"', $e->getMessage(), NotificationEnum::TYPE_ERROR);
        }
    }
}
