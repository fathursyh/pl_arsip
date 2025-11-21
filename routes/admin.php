<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Models\Arsip;
use App\Models\Peminjaman;
use App\Models\User;

Route::middleware([
    'web',
    'auth',
    'role:admin',
])->group(function () {
    // role admin disini
    Route::group(["prefix" => "/admin"], function () {
        Route::get('/home', function () {
            $totalArsip = Arsip::count();
            $activeLoans = Peminjaman::where('status', 'approved')->count();
            $totalUsers = User::where('role', '!=', 'admin')->count();
            $loanHistory = Peminjaman::where('status', 'returned')->count();
            $chartData = Peminjaman::selectRaw('MONTHNAME(borrowed) as month, COUNT(*) as count')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get()->toArray();

            return view('admin.home', [
                'totalArsip' => $totalArsip,
                'activeLoans' => $activeLoans,
                'totalUsers' => $totalUsers,
                'loanHistory' => $loanHistory,
                'chartData' => $chartData
            ]);
        })
            ->name('admin.home');
        Route::get('/arsip/upload', fn() => view('admin.arsip.upload-arsip'))
            ->name('arsip.upload-view');

        Route::post('/arsip/upload', [ArsipController::class, 'upload'])
            ->name('arsip.upload');

        Route::resource('/arsip', ArsipController::class)->except(['create', 'edit']);
        Route::resource('/peminjaman', PeminjamanController::class)->except(['create', 'edit']);

        Route::get('/riwayat', [PeminjamanController::class, 'history'])
            ->name('admin.riwayat');

        Route::resource('/users', UserController::class);
    });
});
