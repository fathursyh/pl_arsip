{{-- daftar peminjaman yang sudah dikembalikan --}}
{{-- halaman lihat semua user biasa --}}
@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Riwayat')
@section('dashboard-title', 'Riwayat Peminjaman')
@section('dashboard-desc', 'Lihat seluruh riwayat data peminjaman')

@section('main')
    <section class="max-w-7xl">
        <!-- Search -->
        <div class="mb-4 flex flex-col gap-2">
            <div class="flex-1">
                <form class="max-w-md" method="GET">
                    <label for="default-search" class="sr-only mb-2 text-sm font-medium text-gray-900">Search</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                            <svg class="h-4 w-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" name="search"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-4 ps-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Cari No. Risalah, Uraian, atau Peminjam"
                            value="{{ request()->query('search') }}" />

                        <button type="submit"
                            class="absolute bottom-2.5 end-2.5 rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if ($riwayat->count() > 0)
            <div class="relative min-h-[50vh] overflow-x-auto rounded-lg pb-12">
                <table class="w-full border border-gray-300 text-left text-sm text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-2 py-2 text-center">No</th>
                            <th class="border border-gray-300 px-4 py-2">Arsip (No. Risalah / Uraian)</th>
                            <th class="border border-gray-300 px-4 py-2">Peminjam</th>
                            <th class="border border-gray-300 px-4 py-2">Tgl Pinjam</th>
                            <th class="border border-gray-300 px-4 py-2">Tgl Kembali</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($riwayat as $peminjaman)
                            <tr class="hover:bg-gray-100">
                                <td class="max-w-32 border border-gray-300 px-4 py-2 text-center">
                                    {{ ($riwayat->currentPage() - 1) * $riwayat->perPage() + $loop->iteration }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="font-semibold text-gray-900">
                                        {{ $peminjaman->arsip->nomor_risalah ?? 'Data Arsip Hilang' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ Str::limit($peminjaman->arsip->uraian_barang ?? '-', 60) }}
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-4 py-2 capitalize">
                                    {{ $peminjaman->user->name ?? 'User Tidak Ditemukan' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ date('d/m/Y', strtotime($peminjaman->borrowed)) }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $peminjaman->returned ? date('d/m/Y', strtotime($peminjaman->returned)) : '-' }}
                                </td>
                                <td class="max-w-12 border border-gray-300 px-4 py-2 text-center">
                                    <span
                                        class="rounded-sm bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                        Returned
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $riwayat->appends(request()->query())->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @else
            @include('shared.no-data')
        @endif
    </section>
@endsection
