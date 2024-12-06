<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LanguageController;
use App\Http\Middleware\changeLang;

use Illuminate\Support\Facades\Route;


Route::middleware('auth', changeLang::class)->group(function () {
    Route::resource('/messages', MessageController::class);
    Route::redirect('/', '/rooms');
    Route::resource('/rooms', RoomController::class);
});
Route::get('/dashboard', function () {
    return redirect()->route('rooms.index');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/rooms/lang/{locale}', [RoomController::class, 'lang'])->name('rooms.lang');
Route::get('/rooms/delete/{id}', [RoomController::class, 'delete'])->name('rooms.delete');
Route::get('/rooms/kick/{id}', [RoomController::class, 'kick'])->name('rooms.kick');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
