<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddOneBookRequest;
use App\Jobs\StoreBookJob;
use App\Services\AutoCreateBookService;

class AutoCreateBookController extends Controller
{
    public function index()
    {
        return view('admin.add-one.index');
    }

    public function store(StoreAddOneBookRequest $request)
    {
        $data = $request->validated();
        $serviceAddBook = new AutoCreateBookService();

        foreach ($data['url'] as $url) {
           $dataUrl = $serviceAddBook->store($url);

            if (!$dataUrl) {
                continue;
            }

            $serviceAddBook->create($dataUrl);

            //StoreBookJob::dispatch($url);

        }
        return redirect()->back();
    }
}
