<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddOneBookRequest;
use App\Jobs\StoreBookJob;
use App\Services\AutoCreateBookService;
use simplehtmldom\HtmlWeb;

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

        $serviceAddBook->filterStore($data['url']);

        return redirect()->back();
    }

    public function storeAll(StoreAddOneBookRequest $request){
        $data = $request->validated();
        $serviceAddBook = new AutoCreateBookService();

        $serviceAddBook->findUrls($data['url'][0]);

        return redirect()->back();
    }
}
