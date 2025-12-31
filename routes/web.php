<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Queue\QueueActionController;
use App\Http\Controllers\Queue\QueueDisplayController;
use App\Http\Controllers\Queue\QueueListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QueueDisplayController::class, 'index'])->name('queue.display');
Route::get('/queue/current', [QueueDisplayController::class, 'current'])->name('queue.current');
Route::post('/queue/take', [QueueDisplayController::class, 'take'])->name('queue.take');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [QueueListController::class, 'index'])->name('dashboard');
    Route::get('queue/waiting-list', [QueueListController::class, 'waitingList'])->name('queue.waiting-list');
    Route::post('next', [QueueActionController::class, 'next'])->name('admin.next');
});

Route::get('/dashboard', fn() => redirect('admin/dashboard'));

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
