<?php

use App\Http\Controllers\ArsipController;

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

        Route::get('/peminjaman', fn() => view('admin.peminjaman'))
        ->name('admin.peminjaman');

        Route::get('/riwayat', fn() => view('admin.riwayat'))
        ->name('admin.riwayat');

        Route::get('/users', fn() => view('admin.users'))
        ->name('admin.users');

        Route::get('/download/{filename}', function ($filename) {
            if (!Storage::disk('public')->exists($filename)) {
                abort(404);
            }
            $path = Storage::disk('public')->path($filename);

            return response()->download($path);
        })->where('filename', '.*')->name('download.arsip');
    });
});
