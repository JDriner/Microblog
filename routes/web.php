<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
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
        Route::get('/home', [HomeController::class, 'home'])->name('home');
        Route::get('/view-profile', [ProfileController::class, 'view'])->name('profile.view');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('posting', PostController::class);
    });
});



require __DIR__ . '/auth.php';