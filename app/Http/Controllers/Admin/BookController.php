<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\BookFilter;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Admin\Author;
use App\Models\Admin\Book;
use App\Models\Admin\Cycle;
use App\Models\Admin\Genre;
use App\Models\Admin\Reader;
use App\Services\BookService;
use Exception;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(FilterRequest $request)
    {
        $data = $request->validated();
        $filter = app()->make(BookFilter::class, ['queryParams' => array_filter($data)]);
        $books = Book::query()->orderBy('id', 'DESC')->filter($filter)->paginate(10);
        return view('admin.book.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::getAuthors();
        $readers = Reader::getReaders();
        $genres = Genre::getGenres();
        $cycles = Cycle::getCycles();

        return view('admin.book.create', compact('authors', 'readers', 'genres', 'cycles'));
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();

        BookService::store($data);

        return redirect()->route('book.index');
    }

    public function edit(Book $id)
    {
        $book = $id;

        $authors = Author::getAuthors();
        $readers = Reader::getReaders();
        $genres = Genre::getGenres();
        $cycles = Cycle::getCycles();

        return view('admin.book.edit', compact('book', 'authors', 'readers', 'genres', 'cycles'));
    }

    public function update(UpdateBookRequest $request, Book $id)
    {
        $data = $request->validated();

        BookService::update($id, $data);

        return redirect()->route('book.index');
    }

    public function destroy(Book $id)
    {
        try {
            DB::beginTransaction();

            $id->genres()->detach($id->genres);
            $id->authors()->detach($id->authors);
            $id->readers()->detach($id->readers);
            $id->delete();

            DB::commit();

            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();

            throw new Exception($e);
        }

    }
}
