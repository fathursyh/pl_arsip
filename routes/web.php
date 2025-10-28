<?php

use Illuminate\Support\Facades\Route;

Route::get("/", fn() => view('landing-page'))->name('home');
Route::middleware(['guest'])->group(function() {
    Route::get('/login', fn() => view('auth.login'))->name('login');
});

Route::middleware([
    'role:admin',
])->group(function () {
    // role admin disini
    Route::group(["prefix" => "/admin"], function () {
        Route::get('/', function () {
            return view('admin.home');
        })->name('admin.home');
        Route::get('/arsip', function () {
            return view('admin.arsip');
        })->name('admin.arsip');
        Route::get('/peminjaman', function () {
            return view('admin.peminjaman');
        })->name('admin.peminjaman');
    });
});

Route::middleware([
    'role:user',
])->group(function () {
    // role user disini
        Route::group(["prefix" => "/user"], function () {
        Route::get('/', function () {
            return 'user';
        })->name('user.home');
    });
});

require_once __DIR__ .'/auth.php';
