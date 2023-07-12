<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
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
        Route::get('/view-profile', [ProfileController::class, 'view'])->name('profile.view');
        Route::get('/view-profile/{id}', [ProfileController::class, 'viewUser'])->name('profile.view-profile');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Routes for posts
        Route::resource('blogpost', PostController::class);
        // Route::get('/viewpost/{id}', [PostController::class, 'show'])->name('blogpost.show');
        // Route::get('/blogpost/{id}', [PostController::class, 'edit'])->name('blogpost.edit');
        // Routes for like & unlike
        Route::post('/like', [PostLikeController::class, 'likePost'])->name('like.likePost');
        Route::post('/unlike', [PostLikeController::class, 'unlikePost'])->name('like.unlikePost');

        // Routes for comments
        Route::post('/sendComment', [CommentController::class, 'sendComment'])->name('sendComment');
    });
});

require __DIR__.'/auth.php';
