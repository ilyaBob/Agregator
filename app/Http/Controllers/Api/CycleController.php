<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreCycleRequest;
use App\Http\Requests\UpdateCycleRequest;
use App\Http\Resources\CycleResource;
use App\Models\Admin\Cycle;
use App\Services\TransliterationService;
use Exception;
use Illuminate\Support\Facades\DB;

class CycleController extends BaseApiController
{
    public function index()
    {
        $cycles = Cycle::with('books')->paginate($this->perPage, ['*'], 'page', $this->page);

        return CycleResource::collection($cycles);
    }

    public function create(StoreCycleRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = TransliterationService::generateSlug($data['name']);
            $cycle = Cycle::create($data);

            DB::commit();

            return CycleResource::make($cycle);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function show(Cycle $id)
    {
        return CycleResource::make($id);
    }

    public function update(UpdateCycleRequest $request, Cycle $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $id->update($data);
            $cycle = $id;

            DB::commit();

            return CycleResource::make($cycle);
        } catch (Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function delete(Cycle $id)
    {
        DB::beginTransaction();
        try {
            if (!empty($id->books[0])) {
                throw new Exception('К данному циклу "' . $id->name . '" привязанны книги, для начала удалите их');
            }

            $id->delete();
            DB::commit();

            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
