<?php

use App\Http\Controllers\NotesController;
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

Route::redirect('/', '/home');

Route::controller(NotesController::class)->group(function() {
    Route::get('/home', 'home')->name('home');

    Route::middleware(['auth', 'verified'])->group(function() {
        Route::get('/heads', 'heads')->name('heads');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
    });
});

Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});

require __DIR__.'/auth.php';
