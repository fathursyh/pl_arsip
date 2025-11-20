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

        $totalArsip = Arsip::count();
        $activeLoans = Peminjaman::where('status', 'approved')->count();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $loanHistory = Peminjaman::where('status', 'returned')->count();
        $chartData = Peminjaman::selectRaw('MONTHNAME(borrowed) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()->toArray();

        Route::get('/home', fn() => view('admin.home', [
            'totalArsip' => $totalArsip,
            'activeLoans' => $activeLoans,
            'totalUsers' => $totalUsers,
            'loanHistory' => $loanHistory,
            'chartData' => $chartData
        ]))
            ->name('admin.home');

        Route::resource('/arsip', ArsipController::class)->except(['create', 'edit']);
        Route::resource('/peminjaman', PeminjamanController::class)->except(['create', 'edit']);

        Route::get('/riwayat', [PeminjamanController::class, 'history'])
            ->name('admin.riwayat');

        Route::resource('/users', UserController::class)
            ->names([
                'index' => 'admin.users',
            ]);
    });
});
