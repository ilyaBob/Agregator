<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddOneBookRequest;
use App\Http\Requests\StoreReaderRequest;
use App\Models\Admin\Book;
use App\Services\AddBookService;

class addOneBookController extends Controller
{
    public function index()
    {
        return view('admin.add-one.index');
    }

    public function store(StoreAddOneBookRequest $request)
    {
        $data = $request->validated();

        $serviceAddBook = new AddBookService();

        $res = $serviceAddBook->store($data['url']);

// https://audiokniga-online.ru/uzhasy-mistika/1563-ruki-polnye-buri.html

        $authors = $res['authors'];
        $readers = $res['readers'];
        $genres = $res['genres'];
        $files = $res['files'];

        unset($res['authors']);
        unset($res['readers']);
        unset($res['genres']);
        unset($res['files']);

        $book = Book::create($res);

        $book->authors()->attach($authors);
        $book->readers()->attach($readers);
        $book->genres()->attach($genres);
        $book->files()->attach($files);

        return redirect()->back();
    }
}
