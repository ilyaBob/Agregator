<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreReaderRequest;
use App\Http\Requests\UpdateReaderRequest;
use App\Http\Resources\ReaderResource;
use App\Models\Admin\Reader;
use App\Services\TransliterationService;
use Exception;
use Illuminate\Support\Facades\DB;

class ReaderController extends BaseApiController
{
    public function index()
    {
        $readers = Reader::with('books')->paginate($this->perPage, ['*'], 'page', $this->page);

        return ReaderResource::collection($readers);
    }

    public function create(StoreReaderRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = TransliterationService::generateSlug($data['name']);
            $reader = Reader::create($data);

            DB::commit();

            return ReaderResource::make($reader);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function show(Reader $id)
    {
        return ReaderResource::make($id);
    }

    public function update(UpdateReaderRequest $request, Reader $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $id->update($data);
            $reader = $id;

            DB::commit();

            return ReaderResource::make($reader);
        } catch (Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function delete(Reader $id)
    {
        DB::beginTransaction();
        try {
            if (!empty($id->books[0])) {
                throw new Exception('К данному чтецу "' . $id->name . '" привязанны книги, для начала удалите их');
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
