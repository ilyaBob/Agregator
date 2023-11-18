<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Genre;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug)
    {
        $genre = Genre::where('slug', $slug)->first();
        $genres = Genre::getGenres();
        $books = $genre->books()->orderBy('id', 'DESC')->paginate(10);

        return view('frontend.index', compact('genres','genre', 'books'));
    }
}
