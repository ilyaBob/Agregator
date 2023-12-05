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
            $book = BookService::store($data);

            DB::commit();

            return BookResource::make($book);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(['message' => $e->getMessage()], 404);
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
            $id->update($data);
            $book = $id;

            DB::commit();

            return BookResource::make($book);
        } catch (Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function delete(Book $id)
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
