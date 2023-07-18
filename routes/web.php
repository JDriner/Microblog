<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TrendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Prevent users from going back after login/logout
Route::group(['middleware' => 'prevent-back-history'], function () {
    // Auth::routes();

    // Middleware for authenticated and verified users
    Route::middleware('auth', 'verified')->group(function () {
        // Routes for Profile management
        Route::get('/home', [HomeController::class, 'home'])->name('home');
        Route::get('/trends', [TrendController::class, 'trends'])->name('trends');
        Route::get('/view-profile', [ProfileController::class, 'view'])->name('profile.view');
        Route::get('/view-profile/{id}', [ProfileController::class, 'viewUser'])->name('profile.view-profile');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Routes for posts
        Route::resource('post', PostController::class);
        Route::get('/share/{id}', [PostController::class, 'share'])->name('post.share');
        Route::post('/editPost', [PostController::class, 'editPost'])->name('post.editPost');
        Route::post('/sharepost', [PostController::class, 'sharepost'])->name('post.sharepost');
        // Routes for like & unlike
        Route::post('/like', [PostLikeController::class, 'likePost'])->name('like.likePost');
        Route::post('/unlike', [PostLikeController::class, 'unlikePost'])->name('like.unlikePost');
        // Routes for follow & unfollow
        Route::get('/listFollows', [FollowerController::class, 'listFollows'])->name('listFollows');
        Route::post('/follow', [FollowerController::class, 'follow'])->name('follow');
        Route::post('/unfollow', [FollowerController::class, 'unfollow'])->name('unfollow');

        // Routes for comments
        Route::post('/sendComment', [CommentController::class, 'sendComment'])->name('sendComment');

        // Routes for search
        Route::get('/search', [SearchController::class, 'search'])->name('search');
    });
});

require __DIR__.'/auth.php';
