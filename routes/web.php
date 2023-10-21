<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CycleController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\ReaderController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SinglePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




// AdminPanel
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::group(['prefix' => 'book', 'controller' => BookController::class], function () {
        Route::get('/', 'index')->name('book.index');
        Route::get('/create', 'create')->name('book.create');
        Route::post('/', 'store')->name('book.store');
        Route::get('/{id}/edit', 'edit')->name('book.edit');
        Route::put('/{id}', 'update')->name('book.update');
        Route::delete('/{id}', 'destroy')->name('book.delete');
    });

    Route::group(['prefix' => 'author', 'controller' => AuthorController::class], function () {
        Route::get('/', 'index')->name('author.index');
        Route::get('/create', 'create')->name('author.create');
        Route::post('/', 'store')->name('author.store');
        Route::get('/{id}/edit', 'edit')->name('author.edit');
        Route::put('/{id}', 'update')->name('author.update');
        Route::delete('/{id}', 'destroy')->name('author.delete');
    });

    Route::group(['prefix' => 'reader', 'controller' => ReaderController::class], function () {
        Route::get('/', 'index')->name('reader.index');
        Route::get('/create', 'create')->name('reader.create');
        Route::post('/', 'store')->name('reader.store');
        Route::get('/{id}/edit', 'edit')->name('reader.edit');
        Route::put('/{id}', 'update')->name('reader.update');
        Route::delete('/{id}', 'destroy')->name('reader.delete');
    });

    Route::group(['prefix' => 'genre', 'controller' => GenreController::class], function () {
        Route::get('/', 'index')->name('genre.index');
        Route::get('/create', 'create')->name('genre.create');
        Route::post('/', 'store')->name('genre.store');
        Route::get('/{id}/edit', 'edit')->name('genre.edit');
        Route::put('/{id}', 'update')->name('genre.update');
        Route::delete('/{id}', 'destroy')->name('genre.delete');
    });

    Route::group(['prefix' => 'cycle', 'controller' => CycleController::class], function () {
        Route::get('/', 'index')->name('cycle.index');
        Route::get('/create', 'create')->name('cycle.create');
        Route::post('/', 'store')->name('cycle.store');
        Route::get('/{id}/edit', 'edit')->name('cycle.edit');
        Route::put('/{id}', 'update')->name('cycle.update');
        Route::delete('/{id}', 'destroy')->name('cycle.delete');
    });

});

// Frontend


Route::get('/', [MainController::class, 'index'])->name('frontend.main.index');
Route::get('/{slug}', [PageController::class, 'index'])->name('frontend.page.index');
Route::get('/{slug}/{slugBook}', [SinglePageController::class, 'index'])->name('frontend.single.index');
