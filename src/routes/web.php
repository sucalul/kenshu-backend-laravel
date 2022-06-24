<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Article
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/new', [ArticleController::class, 'new']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::group(['middleware' => ['checkSignin']], function () {
    Route::post('/articles', [ArticleController::class, 'create']);
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit']);
    Route::patch('/articles/{id}', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy');;
});


// Auth
Route::get('/auth/signup', [AuthController::class, 'viewSignup']);
Route::post('/auth/signup', [AuthController::class, 'signup']);
Route::get('/auth/signin', [AuthController::class, 'viewSignin']);
Route::post('/auth/signin', [AuthController::class, 'signin']);
