<?php

Route::middleware([
    'web',
    'auth',
    'role:user',
])->group(function () {
    // role user disini
        Route::group(["prefix" => "/user"], function () {
        Route::get('/home', function () {
            return view('user.home');
        })->name('user.home');
        Route::get('/arsip', function () {
            return view('user.arsip');
        })->name('user.arsip');
                Route::get('/peminjaman', function () {
            return view('user.peminjaman');
        })->name('user.peminjaman');
    });
});
