<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Genre;

class PageController extends Controller
{
    public function index($slug)
    {
        $genre = Genre::where('slug', $slug)->first();
        $genres = Genre::getGenres();
        $books = $genre->books()->orderBy('id', 'DESC')->paginate(10);

        $topBook = Book::query()
            ->join('top', 'books.id', '=', 'top.top_book_id')
            ->whereNotNull('top_book_id')
            ->limit(6)
            ->get();

        return view('frontend.index', compact('genres','genre', 'books', 'topBook'));
    }
}
