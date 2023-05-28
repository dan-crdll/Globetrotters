<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\ArticleWritingController;
use App\Http\Controllers\LandingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/check_user_exists/{user}', [LandingController::class, 'checkUserExists']);
Route::get('/check_email_exists/{email}', [LandingController::class, 'checkEmailExists']);
Route::get('/get_usplash_image/{prompt?}', [ArticleWritingController::class, 'getUnsplash']);
Route::get('/get_usplash_image', [ArticleWritingController::class, 'getUnsplash']);
Route::get('/get_tweets/{hashtag?}', [TweetsController::class, 'getTweets']);
Route::get('/most_popular', [HomeController::class, 'getMostPopular']);
Route::get('/search_alike/{word}', [HomeController::class, 'getAlike']);
Route::get('/is_liked', [ArticleController::class, 'isLiked']);
Route::get('/get_comments/{article}', [ArticleController::class, 'getComments']);
