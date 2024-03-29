<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Genre;

class MainController extends Controller
{
    public function index()
    {
        $books = Book::query()->orderBy('id', 'DESC')->paginate(10, ['*'], 'page')->onEachSide(3);
        $genres = Genre::getGenres();

        $topBook = Book::query()
            ->join('top', 'books.id', '=', 'top.top_book_id')
            ->whereNotNull('top_book_id')
            ->limit(6)
            ->get();

        return view('frontend.index', compact('books', 'genres', 'topBook'));
    }
}

