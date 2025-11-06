<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\PeminjamanController;

Route::middleware([
    'web',
    'auth',
    'role:admin',
])->group(function () {
    // role admin disini
    Route::group(["prefix" => "/admin"], function () {
        Route::get('/home', fn() => view('admin.home'))
        ->name('admin.home');

        Route::resource('/arsip', ArsipController::class)->except(['create', 'edit']);
        Route::resource('/peminjaman', PeminjamanController::class)->except(['create', 'edit']);

        Route::get('/riwayat', [PeminjamanController::class, 'history'])
        ->name('admin.riwayat');

        Route::get('/users', fn() => view('admin.users'))
        ->name('admin.users');
    });
});
