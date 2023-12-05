<?php

namespace App\Http\Controllers\Api;

use App\Enums\MassageEnum;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Admin\Author;
use App\Services\TransliterationService;
use Exception;
use Illuminate\Support\Facades\DB;

class AuthorController extends BaseApiController
{
    public function index()
    {
        $authors = Author::with('books')->paginate($this->perPage, ['*'], 'page', $this->page);

        return AuthorResource::collection($authors);
    }

    public function create(StoreAuthorRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $data['slug'] = TransliterationService::generateSlug($data['name']);
            $author = Author::create($data);

            DB::commit();

            return AuthorResource::make($author);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function show(Author $id)
    {
        $author = $id->load('books');

        return AuthorResource::make($author);
    }

    public function update(UpdateAuthorRequest $request, Author $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $id->update($data);
            $author = $id;

            DB::commit();

            return AuthorResource::make($author);
        } catch (Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function delete(Author $id)
    {
        DB::beginTransaction();
        try {
            if (!empty($id->books[0])) {
                throw new Exception('К данному жанру "' . $id->name . '" привязанны книги, для начала удалите их');
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
