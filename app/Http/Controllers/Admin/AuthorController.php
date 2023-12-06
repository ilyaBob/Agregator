<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MassageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Admin\Author;
use App\Services\TransliterationService;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::query()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.author.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.author.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = TransliterationService::generateSlug($data['name']);

        Author::create($data);

        return redirect()->route('author.index');
    }

    public function edit(Author $id)
    {
        $author = $id;
        return view('admin.author.edit', compact('author'));
    }

    public function update(UpdateAuthorRequest $request, Author $id)
    {
        $data = $request->validated();

        if(!key_exists('is_active', $data)){
            $data['is_active'] = 0;
        }

        $id->update($data);

        return redirect()->route('author.index');
    }

    public function destroy(Author $id)
    {
        if (!empty($id->books)) {
            return redirect()->back()->with(MassageEnum::TYPE_ERROR, 'К данному автору "'.$id->name.'" привязанны книги, для начала удалите их');
        }

        $id->delete();

        return redirect()->back();
    }
}
