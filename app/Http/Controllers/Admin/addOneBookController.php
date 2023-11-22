<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddOneBookRequest;
use App\Services\AutoCreateBookService;

class addOneBookController extends Controller
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
        }
        return redirect()->back();
    }
}
