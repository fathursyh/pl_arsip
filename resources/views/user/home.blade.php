@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Home')
@section('dashboard-title', 'Dashboard')
@section('dashboard-desc', 'Selamat datang kembali! Berikut statistik terbaru Anda')
@section('main')
    <!-- Stats Grid -->
    <div class="mb-6 grid flex-1 grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Stat Card 1 - Total Arsip -->
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow">
            <div class="mb-4 flex items-center justify-between">
                <div class="rounded-lg bg-blue-50 p-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-green-600">+12%</span>
            </div>
            <h3 class="mb-1 text-sm font-medium text-gray-600">Total Arsip</h3>
            <p class="text-3xl font-bold text-gray-900">1,234</p>
        </div>

        <!-- Stat Card 2 - Peminjaman Aktif -->
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow">
            <div class="mb-4 flex items-center justify-between">
                <div class="rounded-lg bg-blue-50 p-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-green-600">+5%</span>
            </div>
            <h3 class="mb-1 text-sm font-medium text-gray-600">Peminjaman Aktif</h3>
            <p class="text-3xl font-bold text-gray-900">89</p>
        </div>

        <!-- Stat Card 3 - Total Users -->
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow">
            <div class="mb-4 flex items-center justify-between">
                <div class="rounded-lg bg-blue-50 p-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-green-600">+8%</span>
            </div>
            <h3 class="mb-1 text-sm font-medium text-gray-600">Total Users</h3>
            <p class="text-3xl font-bold text-gray-900">456</p>
        </div>

        <!-- Stat Card 4 - Dokumen Baru -->
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow">
            <div class="mb-4 flex items-center justify-between">
                <div class="rounded-lg bg-blue-50 p-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-red-600">-2%</span>
            </div>
            <h3 class="mb-1 text-sm font-medium text-gray-600">Dokumen Baru</h3>
            <p class="text-3xl font-bold text-gray-900">23</p>
        </div>
    </div>

    <!-- Chart Placeholder -->
    <div class="flex-2 flex flex-col rounded-lg border border-gray-200 bg-white p-6 shadow">
        <div class="mb-4">
            <h2 class="text-xl font-bold text-gray-900">Activity Overview</h2>
            <p class="mt-1 text-sm text-gray-600">Monthly statistics and trends</p>
        </div>
        <div class="flex flex-1 items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50">
            <div class="text-center">
                <svg class="mx-auto mb-4 h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                <p class="font-medium text-gray-500">Chart Placeholder</p>
                <p class="mt-1 text-sm text-gray-400">Chart component will be inserted here</p>
            </div>
        </div>
    </div>
    </div>
@endsection
