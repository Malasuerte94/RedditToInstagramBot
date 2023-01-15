<?php

use App\Http\Controllers\JobsController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostController::class, 'index']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
Route::patch('/posts/{id}', [PostController::class, 'update']);

//@TODO Still wokring on this
Route::post('/job/reddit/start', [JobsController::class, 'startRedditScrapperJob']);
Route::post('/job/reddit/stop', [JobsController::class, 'stopRedditScrapperJob']);