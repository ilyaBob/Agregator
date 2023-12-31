<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MassageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReaderRequest;
use App\Http\Requests\UpdateReaderRequest;
use App\Models\Admin\Reader;
use App\Services\TransliterationService;

class ReaderController extends Controller
{
    public function index()
    {
        $readers = Reader::query()->orderBy('id', 'DESC')->paginate(10);
        return view('admin.reader.index', compact('readers'));
    }

    public function create()
    {
        return view('admin.reader.create');
    }

    public function store(StoreReaderRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = TransliterationService::generateSlug($data['name']);

        Reader::create($data);

        return redirect()->route('reader.index');
    }

    public function edit(Reader $id)
    {
        $reader = $id;
        return view('admin.reader.edit', compact('reader'));
    }

    public function update(UpdateReaderRequest $request, Reader $id)
    {
        $data = $request->validated();

        if(!key_exists('is_active', $data)){
            $data['is_active'] = 0;
        }

        $id->update($data);

        return redirect()->route('reader.index');
    }

    public function destroy(Reader $id)
    {
        if (!empty($id->books)) {
            return redirect()->back()->with(MassageEnum::TYPE_ERROR, 'К данному чтецу "'.$id->name.'" привязанны книги, для начала удалите их');
        }

        $id->delete();

        return redirect()->back();
    }
}
