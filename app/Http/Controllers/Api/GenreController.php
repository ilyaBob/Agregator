<?php

namespace App\Http\Controllers\Api;

use App\Enums\MassageEnum;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Admin\Genre;
use App\Services\TransliterationService;
use Exception;
use Illuminate\Support\Facades\DB;

class GenreController extends BaseApiController
{
    public function index()
    {
        $genres = Genre::with('books')->paginate($this->perPage, ['*'], 'page', $this->page);

        return GenreResource::collection($genres);
    }

    public function create(StoreGenreRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = TransliterationService::generateSlug($data['name']);
            $genre = Genre::create($data);

            DB::commit();

            return GenreResource::make($genre);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function show(Genre $id)
    {
        return GenreResource::make($id);
    }

    public function update(UpdateGenreRequest $request, Genre $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $id->update($data);
            $genre = $id;

            DB::commit();

            return GenreResource::make($genre);
        } catch (Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function delete(Genre $id)
    {
        DB::beginTransaction();
        try {
            if (!empty($id->books[0])) {
                throw new Exception('К данному автору "' . $id->name . '" привязанны книги, для начала удалите их');
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
