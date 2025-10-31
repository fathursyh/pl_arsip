<?php

use App\Http\Controllers\ArsipController;

Route::middleware([
    'web',
    'auth',
    'role:admin',
])->group(function () {
    // role admin disini
    Route::group(["prefix" => "/admin"], function () {
        Route::get('/home', function () {
            return view('admin.home');
        })->name('admin.home');
        Route::resource('/arsip', ArsipController::class)->except(['create', 'edit'])->names([
            'index' => 'admin.arsip',
            'store' => 'admin.arsip.store',
            'update' => 'admin.arsip.update',
            'destroy' => 'admin.arsip.delete'
        ]);
        Route::get('/peminjaman', function () {
            return view('admin.peminjaman');
        })->name('admin.peminjaman');
        Route::get('/riwayat', function () {
            return view('admin.riwayat');
        })->name('admin.riwayat');
        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');
    });
});
