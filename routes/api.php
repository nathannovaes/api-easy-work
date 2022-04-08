<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\NoticeController;
use Illuminate\Support\Facades\Route;

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

Route::get('categories', [CategoryController::class, 'index']);
Route::post('category', [CategoryController::class, 'store']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::put('category/{id}', [CategoryController::class, 'update']);
Route::delete('category/{id}', [CategoryController::class, 'destroy']);

Route::get('notices', [NoticeController::class, 'index']);
Route::post('notice', [NoticeController::class, 'store']);
Route::get('notice/{id}', [NoticeController::class, 'show']);
Route::put('notice/{id}', [NoticeController::class, 'update']);
Route::delete('notice/{id}', [NoticeController::class, 'destroy']);
