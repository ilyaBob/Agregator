<?php

use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CycleController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\ReaderController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});


// Author
Route::group(['prefix' => 'author', 'controller' => AuthorController::class], function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::post('/create', 'create');
        Route::patch('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});

// Genre
Route::group(['prefix' => 'genre', 'controller' => GenreController::class], function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::post('/create', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});

// Reader
Route::group(['prefix' => 'reader', 'controller' => ReaderController::class], function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::post('/create', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});

// Cycle
Route::group(['prefix' => 'cycle', 'controller' => CycleController::class], function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::post('/create', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});

// Books
Route::group(['prefix' => 'book', 'controller' => BookController::class], function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::post('/create', 'create');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });
});

