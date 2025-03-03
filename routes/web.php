<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ThreadController::class, 'index'])->name('home');

Route::resource('threads', ThreadController::class);

Route::post('threads/{thread}/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::patch('replies/{reply}', [ReplyController::class, 'update'])->name('replies.update');
Route::delete('replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy');
Route::post('replies/{reply}/solution', [ReplyController::class, 'markAsSolution'])->name('replies.solution');
Route::post('replies/{reply}/vote', [ReplyController::class, 'vote'])->name('replies.vote');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
