<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
 
// Public route

require __DIR__.'/auth.php';
Route::name('user.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [App\Http\Controllers\User\EventController::class,'index'])->name('user.events.index');
});

//Authenticated routes
require __DIR__.'/auth.php';
Route::name('user.')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('user/events', App\Http\Controllers\User\EventController::class);
    Route::get('user/events/{id}/tasks', [App\Http\Controllers\User\TaskController::class,'create'])->name('events.tasks.create');
    Route::post('user/events/{id}/tasks', [App\Http\Controllers\User\TaskController::class,'store'])->name('events.tasks.store');
    Route::delete('user/events/{id}/tasks', [App\Http\Controllers\User\TaskController::class,'destroy'])->name('events.tasks.destroy');
    Route::get('user/events/{id}/tasks/complete', \App\Http\Controllers\User\TaskCompleteController::class)->name('events.tasks.complete');
});


