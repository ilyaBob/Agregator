<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Admin\Genre;
use App\Services\TransliterationService;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function store(StoreGenreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = TransliterationService::generateSlug($data['name']);

        Genre::create($data);

        return redirect()->route('genre.index');
    }

    public function edit(Genre $id)
    {
        $genre = $id;
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(UpdateGenreRequest $request, Genre $id)
    {
        $data = $request->validated();

        if(!key_exists('is_active', $data)){
            $data['is_active'] = 0;
        }

        $id->update($data);

        return redirect()->route('genre.index');
    }

    public function destroy(Genre $id)
    {
        $id->delete();
        return redirect()->back();
    }
}
