@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Home')
@section('dashboard-title', 'Beranda')
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
            </div>
            <h3 class="mb-1 text-sm font-medium text-gray-600">Total Arsip</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $totalArsip }}</p>
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
            </div>
            <h3 class="mb-1 text-sm font-medium text-gray-600">Peminjaman Aktif</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $activeLoans }}</p>
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
            </div>
            <h3 class="mb-1 text-sm font-medium text-gray-600">Total Users</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
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
            </div>
            <h3 class="mb-1 text-sm font-medium text-gray-600">Riwayat Peminjaman</h3>
            <p class="text-3xl font-bold text-gray-900">{{ $loanHistory }}</p>
        </div>
    </div>

    <!-- Chart Placeholder -->
    <div class="flex-2 flex flex-col rounded-lg border border-gray-200 bg-white p-6 shadow">
        <div class="mb-4">
            <h2 class="text-xl font-bold text-gray-900">Peminjaman Tahun {{ date('Y') }}</h2>
            <p class="mt-1 text-sm text-gray-600">Statistik peminjaman tahun ini</p>
        </div>
        <div class="p-8 flex flex-1 items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50">
            <div class="relative h-full w-full">
                <canvas id="chartData"></canvas>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const data = @json($chartData);
        const ctx = document.getElementById('chartData').getContext('2d');
        console.log(data);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.map(item => item.month),
                datasets: [{
                    label: 'Peminjaman',
                    data: data.map(item => item.count),
                    borderColor: '#2563EB', // Tailwind blue-600
                    backgroundColor: 'rgba(37, 99, 235, 0.1)', // Blue with opacity
                    borderWidth: 2,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563EB',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true, // Fills area under the line
                    tension: 0.4 // Makes the line curvy (smooth)
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Hiding legend since title explains it
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6' // Lighter grid lines
                        },
                        ticks: {
                            stepSize: 1 // Ensure whole numbers only (no 1.5 loans)
                        }
                    },
                    x: {
                        grid: {
                            display: false // Clean look without vertical grid lines
                        }
                    }
                }
            }
        });
    </script>
@endsection
