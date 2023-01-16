<?php

use App\Http\Controllers\HashtagController;
use App\Http\Controllers\IgAccountController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RedditScraperController;
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


// //@TODO Still wokring on this
// Route::post('/job/reddit/start', [JobsController::class, 'startRedditScrapperJob']);
// Route::post('/job/reddit/stop', [JobsController::class, 'stopRedditScrapperJob']);



//posts
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);
    Route::patch('/posts/{id}', [PostController::class, 'update']);

    //instagram accounts
    Route::get('/ig-accounts', [IgAccountController::class, 'index']);
    Route::post('/ig-accounts/connect', [IgAccountController::class, 'create']);

    //hashtags
    Route::get('/hashtags', [HashtagController::class, 'index']);
    Route::post('/hashtags', [HashtagController::class, 'store']);

    //upload manualy to instagram
    Route::post('/posts/upload', [InstagramController::class, 'postInstagramMedia']);

    //reddit scraper
    Route::get('/reddit-scrapers', [RedditScraperController::class, 'index']);
    Route::post('/reddit-scrapers', [RedditScraperController::class, 'store']);
});