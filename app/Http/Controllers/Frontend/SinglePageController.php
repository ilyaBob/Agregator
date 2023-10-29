<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Cycle;
use App\Models\Admin\Genre;
use Exception;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    public function index($slug, $slugBook)
    {

        $genres = Genre::getGenres();
        $book = Book::where('slug', $slugBook)->first();
        $genre = Genre::where('slug', $slug)->first();

        if (!isset($book) || !isset($genre)) {
            abort(404);
        }

        $cycle = null;
        if($book->cycle){
            $cycle = Cycle::find($book->cycle->id);
        }

        return view('frontend.single', compact('genres', 'book', 'cycle'));
    }
}
