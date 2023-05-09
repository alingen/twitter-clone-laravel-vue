<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfomationController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\RetweetController;

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

Route::resource('/comments', 'App\Http\Controllers\CommentController')->middleware('auth');;

Route::resource('/tweets', 'App\Http\Controllers\TweetController', ['only' => ['store', 'show',]]);

Route::resource(
    '/user',
    'App\Http\Controllers\UserController'
);

Route::get(
    '/top',
    [HomeController::class, 'index']
)->name('top');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tweets.likes', LikeController::class)->only(['store', 'destroy', 'delete']);
    Route::get('/tweets/{tweet}/liked', [TweetController::class, 'isLikedByCurrentUser']);
    Route::resource('tweets.retweets', RetweetController::class)->only(['store', 'destroy', 'delete']);
    Route::get('/tweets/{tweet}/retweetCheck', [TweetController::class, 'isRetweetByCurrentUser']);
    Route::get('/tweets/{tweet}/findRetweetUser', [RetweetController::class, 'retweetUser']);
    Route::get('/info', [InfomationController::class, 'index']);
});

require __DIR__ . '/auth.php'; //auth.phpをマージ
