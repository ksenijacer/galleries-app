<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::get('/profile', [AuthController::class, 'getActiveUser'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('/refresh-token', [AuthController::class, 'refreshToken']);


Route::get('/galleries', [GalleriesController::class, 'index'])->name('index');
Route::post('/galleries', [GalleriesController::class, 'index'])->name('index');
Route::post('/galleries', [GalleriesController::class, 'store'])->middleware('auth');
Route::get('/galleries/{gallery}', [GalleriesController::class, 'show']);
Route::put('/galleries/{gallery}', [GalleriesController::class, 'update'])->middleware('auth');
Route::delete('/galleries/{gallery}', [GalleriesController::class, 'destroy'])->middleware('auth');


Route::post('/add-comment/{gallery}', [CommentController::class, 'store'])->middleware('auth');
Route::get('/comments/{gallery}', [CommentController::class, 'show'])->middleware('auth');
Route::delete('/delete-comment/{comment}', [CommentController::class, 'destroy'])->middleware('auth');
