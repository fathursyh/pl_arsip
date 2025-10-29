<?php

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
        Route::get('/arsip', function () {
            return view('admin.arsip');
        })->name('admin.arsip');
        Route::get('/peminjaman', function () {
            return view('admin.peminjaman');
        })->name('admin.peminjaman');
        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');
    });
});
