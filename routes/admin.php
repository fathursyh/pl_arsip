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

        Route::resource('/arsip', ArsipController::class)->except(['create', 'edit'])->names([
            'index' => 'admin.arsip',
            'store' => 'admin.arsip.store',
            'update' => 'admin.arsip.update',
            'destroy' => 'admin.arsip.delete'
        ]);

        Route::get('/peminjaman', [PeminjamanController::class,'index'])
        ->name('admin.peminjaman');

        Route::get('/riwayat', fn() => view('admin.riwayat'))
        ->name('admin.riwayat');

        Route::get('/users', fn() => view('admin.users'))
        ->name('admin.users');
    });
});
