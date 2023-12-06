<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Admin\Book;
use App\Services\BookService;
use App\Services\TransliterationService;
use Exception;
use Illuminate\Support\Facades\DB;

class BookController extends BaseApiController
{
    public function index()
    {
        $books = Book::with(['genres', 'authors', 'readers'])->paginate($this->perPage, ['*'], 'page', $this->page);

        return BookResource::collection($books);
    }

    public function create(StoreBookRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $book = BookService::store($data)->load(['genres', 'readers', 'authors']);

            DB::commit();

            return BookResource::make($book);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function show(Book $id)
    {
        $book = $id->load(['genres', 'authors', 'readers']);

        return BookResource::make($book);
    }

    public function update(UpdateBookRequest $request, Book $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $book = BookService::update($id, $data)->load(['genres', 'readers', 'authors']);

            DB::commit();

            return BookResource::make($book);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    public function delete(Book $id)
    {
        DB::beginTransaction();
        try {
            $id->genres()->detach($id->genres);
            $id->authors()->detach($id->authors);
            $id->readers()->detach($id->readers);
            $id->delete();

            DB::commit();

            return response()->json(['message' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
