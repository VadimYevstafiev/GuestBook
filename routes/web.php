<?php

use App\Http\Controllers\Ajax\RemoveImageController;
use App\Http\Controllers\Ajax\RemoveTextFilesController;
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
        Route::get('/edit/{note}', 'edit')->name('edit');
        Route::put('/update/{note}', 'update')->name('update');
        Route::delete('/delete/{note}', 'destroy')->name('delete');
    });
});

Route::controller(ProfileController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'edit')->name('profile.edit');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::delete('/profile', 'destroy')->name('profile.destroy');
});

Route::name('ajax.')->prefix('ajax')->middleware('auth')->group(function () {
    Route::delete('images/{image}', RemoveImageController::class)->name('images.delete');
    Route::delete('text_files/{file}', RemoveTextFilesController::class)->name('text_files.delete');
});

require __DIR__.'/auth.php';
