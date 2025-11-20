@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Home')
@section('dashboard-title', 'Beranda')
@section('dashboard-desc', 'Selamat datang kembali! Berikut statistik terbaru Anda')
@section('main')
       <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6 flex-1">
                <!-- Stat Card 1 - Total Arsip -->
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-600 text-sm font-medium mb-1">Total Arsip</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalArsip }}</p>
                </div>

                <!-- Stat Card 2 - Peminjaman Aktif -->
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-600 text-sm font-medium mb-1">Peminjaman Aktif</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $activeLoans }}</p>
                </div>

                <!-- Stat Card 3 - Total Users -->
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-600 text-sm font-medium mb-1">Total Users</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                </div>

                <!-- Stat Card 4 - Dokumen Baru -->
                <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-gray-600 text-sm font-medium mb-1">Riwayat Peminjaman</h3>
                    <p class="text-3xl font-bold text-gray-900">{{ $loanHistory }}</p>
                </div>
            </div>

            <!-- Chart Placeholder -->
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200 flex-2 flex flex-col">
                <div class="mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Activity Overview</h2>
                    <p class="text-gray-600 text-sm mt-1">Monthly statistics and trends</p>
                </div>
                <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center flex-1">
                    <div class="text-center">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <p class="text-gray-500 font-medium">Chart Placeholder</p>
                        <p class="text-gray-400 text-sm mt-1">Chart component will be inserted here</p>
                    </div>
                </div>
            </div>
        </div>
@endsection
