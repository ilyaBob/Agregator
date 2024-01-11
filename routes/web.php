<?php

use App\Http\Controllers\Admin\AutoCreateBookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CycleController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\ImportExportController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReaderController;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\SinglePageController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// AdminPanel
Route::middleware('admin')->group(function (){
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');

        Route::group(['prefix' => 'book', 'controller' => BookController::class, 'as' => 'book.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'author', 'controller' => AuthorController::class, 'as' => 'author.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'reader', 'controller' => ReaderController::class, 'as' => 'reader.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'genre', 'controller' => GenreController::class, 'as' => 'genre.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'cycle', 'controller' => CycleController::class, 'as' => 'cycle.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('delete');
        });

        Route::group(['prefix' => 'add-one', 'controller' => AutoCreateBookController::class, 'as' => 'add-one.'], function(){
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::post('/all', 'storeAll')->name('store-all');
        });

        Route::group(['prefix' => 'import', 'controller' => ImportExportController::class, 'as' => 'import.'], function(){
            Route::get('/', 'index')->name('index');
            Route::get('/export', 'export')->name('export');
            Route::post('/', 'store')->name('store');
        });

        Route::group(['prefix' => 'notification', 'controller' => NotificationController::class, 'as' => 'notification.'], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}', 'show')->name('show');
            Route::delete('/{id}', 'destroy')->name('destroy');
        });

    });
});

// Frontend
Route::group(['as' => 'frontend.'], function (){
    Route::get('/', [MainController::class, 'index'])->name('main.index');
    Route::get('/{slug}', [PageController::class, 'index'])->name('page.index');
    Route::get('/{slug}/{slugBook}', [SinglePageController::class, 'index'])->name('single.index');
});

