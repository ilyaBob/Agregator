<?php

namespace App\Http\Controllers\Admin;

use App\Enums\MassageEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCycleRequest;
use App\Http\Requests\UpdateCycleRequest;
use App\Models\Admin\Cycle;
use App\Services\TransliterationService;

class CycleController extends Controller
{
    public function index()
    {
        $cycles = Cycle::all();
        return view('admin.cycle.index', compact('cycles'));
    }

    public function create()
    {
        return view('admin.cycle.create');
    }

    public function store(StoreCycleRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = TransliterationService::generateSlug($data['name']);

        Cycle::create($data);

        return redirect()->route('cycle.index');
    }

    public function edit(Cycle $id)
    {
        $cycle = $id;
        return view('admin.cycle.edit', compact('cycle'));
    }

    public function update(UpdateCycleRequest $request, Cycle $id)
    {
        $data = $request->validated();

        if(!key_exists('is_active', $data)){
            $data['is_active'] = 0;
        }

        $id->update($data);

        return redirect()->route('cycle.index');
    }

    public function destroy(Cycle $id)
    {
        if (!empty($id->books)) {
            return redirect()->back()->with(MassageEnum::TYPE_ERROR, 'К данному циклу "'.$id->name.'" привязанны книги, для начала удалите их');
        }

        $id->delete();

        return redirect()->back();
    }
}
