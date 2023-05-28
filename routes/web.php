<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\ArticleWritingController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleListController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (session('user_id')) {
        return redirect('/home');
    } else {
        return redirect('/login');
    }
});
Route::get('/login', [LandingController::class, 'showLogin']);
Route::get('/signup', [LandingController::class, 'showSignUp']);
Route::post('/login', [LandingController::class, 'login']);
Route::post('/signup', [LandingController::class, 'signUp']);
Route::get('/logout', function () {
    session()->flush();
    return redirect('login');
});

Route::get('/home', [HomeController::class, 'showHome']);


Route::get('/article_writing', [ArticleWritingController::class, 'showArticleWriting']);
Route::get('/article/{article}', [ArticleController::class, 'showArticle']);
Route::get('/article_list', [ArticleListController::class, 'showArticleList']);
Route::get('/profile/{username}', [ProfileController::class, 'showProfile']);
Route::get('/delete_article/{id}', [ArticleController::class, 'deleteArticle']);
Route::post('/article_create', [ArticleWritingController::class, 'createArticle']);
Route::get('/is_liked/{article}', [ArticleController::class, 'isLiked']);
Route::get('/like/{article}', [ArticleController::class, 'like']);
Route::post('/comment', [ArticleController::class, 'postComment']);
Route::get('/account/{username}', [ProfileController::class, 'showAccount']);
Route::get('/follows/{followed}', [ProfileController::class, 'follows']);
Route::get('/add_follow/{followed}', [ProfileController::class, 'addFollow']);
Route::get('/remove_follow/{followed}', [ProfileController::class, 'removeFollow']);
