<?php

use App\Http\Controllers\UserRoleController;

Route::middleware([
    'web',
    'auth',
    'role:user',
])->group(function () {
    // role user disini
    Route::group(["prefix" => "/user"], function () {
        Route::get('/home', [UserRoleController::class, 'index'])->name('user.home');
        Route::get('/arsip', [UserRoleController::class, 'arsip'])->name('user.arsip');
        Route::get('/peminjaman', [UserRoleController::class, 'peminjaman'])->name('user.peminjaman');
        Route::PUT('/peminjaman/pinjam/{id}', [UserRoleController::class, 'pinjamArsip'])->name('user.peminjaman-arsip');
    });
});
