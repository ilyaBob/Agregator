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
        $data = $request->validated();
        $data['slug'] = TransliterationService::generateSlug($data['name']);
        $author = Author::create($data);

        return new AuthorResource($author);
    }

    public function update(UpdateAuthorRequest $request, Author $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $id->update($data);
            $author = $id;

            DB::commit();
            return new AuthorResource($author);
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function destroy(Author $id)
    {
        if (!empty($id->books)) {
            return redirect()->back()->with(MassageEnum::TYPE_ERROR, 'К данному автору "' . $id->name . '" привязанны книги, для начала удалите их');
        }

        $id->delete();

        return redirect()->back();
    }
}
