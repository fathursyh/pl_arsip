<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get("/", fn() => view('landing-page'))->name('home');

Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
});

require_once __DIR__ .'/admin.php';
require_once __DIR__ .'/user.php';
require_once __DIR__ .'/auth.php';
