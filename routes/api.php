<?php

use App\Http\Controllers\HashtagController;
use App\Http\Controllers\IgAccountController;
use App\Http\Controllers\InstagramAutomationController;
use App\Http\Controllers\InstagramController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RedditAutomationController;
use App\Http\Controllers\RedditScraperController;
use App\Services\Instagram\InstagramAutomationService;
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

    //reddit automation
    Route::get('/reddit-automation', [RedditAutomationController::class, 'index']);
    Route::post('/reddit-automation', [RedditAutomationController::class, 'store']);
    Route::delete('/reddit-automation', [RedditAutomationController::class, 'destroy']);
    Route::patch('/reddit-automation/{id}', [RedditAutomationController::class, 'update']);
    Route::post('/reddit-automation/start-test/{id}', [RedditAutomationController::class, 'testStart']);

    //instagram automation
    Route::get('/instagram-automation', [InstagramAutomationController::class, 'index']);
    Route::post('/instagram-automation', [InstagramAutomationController::class, 'store']);
    Route::delete('/instagram-automation', [InstagramAutomationController::class, 'destroy']);
    Route::patch('/instagram-automation/{id}', [InstagramAutomationController::class, 'update']);
    Route::get('/instagram-automation/get-post/test', [InstagramAutomationService::class, 'startUploading']);
});