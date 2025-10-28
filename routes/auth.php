<?php

use App\Http\Controllers\AuthController;

Route::middleware(['web'])->group(function () {
    Route::post('/login', [AuthController::class, 'login'])
    // ->middleware('throttle:10,1')
    ->name('auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])
    ->name('auth.logout');
});
