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
        // routes for the navigation
        Route::get('/home', [HomeController::class, 'home'])->name('home');
        Route::get('/trends', [TrendController::class, 'trends'])->name('trends');

        // Routes for Profile management
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/me', [ProfileController::class, 'view'])->name('view');
            Route::get('/{id}', [ProfileController::class, 'viewUser'])->name('view-profile');
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('update');
            Route::post('/', [ProfileController::class, 'updatePicture'])->name('updatePicture');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        });

        // Routes for posts
        Route::resource('post', PostController::class);
        Route::get('/share/{id}', [PostController::class, 'share'])->name('post.share');
        Route::post('/editPost', [PostController::class, 'update'])->name('post.update');
        Route::post('/sharepost', [PostController::class, 'sharepost'])->name('post.sharepost');

        // Routes for like & unlike
        Route::post('/like', [PostLikeController::class, 'likePost'])->name('like.likePost');
        Route::post('/unlike', [PostLikeController::class, 'unlikePost'])->name('like.unlikePost');

        // Routes for listing the list follows, follow & unfollow
        Route::get('/follows/{slug}', [FollowerController::class, 'listFollows'])->name('follows');
        Route::post('/follow', [FollowerController::class, 'follow'])->name('follow');
        Route::post('/unfollow', [FollowerController::class, 'unfollow'])->name('unfollow');

        // Routes for comments
        Route::prefix('/')->name('comment.')->group(function () {
            Route::resource('comment', CommentController::class);
            Route::post('/send-comment', [CommentController::class, 'sendComment'])->name('send-comment');
            Route::get('/view-comment/{id}', [CommentController::class, 'view'])->name('view-comment');
            Route::post('/edit-comment', [CommentController::class, 'edit'])->name('edit-comment');
        });

        // Routes for search
        Route::get('/search', [SearchController::class, 'search'])->name('search');
    });
});

require __DIR__.'/auth.php';
