@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Riwayat Peminjaman')
@section('dashboard-title', 'Riwayat Peminjaman')
@section('dashboard-desc', 'Lihat status dan riwayat peminjaman arsip Anda')

@section('main')
    <section class="max-w-7xl">
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
                            placeholder="Cari berdasarkan Nomor Risalah" value="{{ request()->query('search') }}" />

                        <button type="submit"
                            class="absolute bottom-2.5 end-2.5 rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if ($peminjamans->count() > 0)
            <div class="relative min-h-[50vh] overflow-x-auto rounded-lg pb-12">
                <table class="w-full border border-gray-300 text-left text-sm text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-2 py-2 text-center">No</th>
                            <th class="border border-gray-300 px-4 py-2">No. Risalah</th>
                            <th class="border border-gray-300 px-4 py-2">Tgl Peminjaman</th>
                            <th class="border border-gray-300 px-4 py-2">Tgl Pengembalian</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($peminjamans as $peminjaman)
                            <tr class="hover:bg-gray-100">
                                <td class="max-w-32 border border-gray-300 px-4 py-2 text-center">
                                    {{ ($peminjamans->currentPage() - 1) * $peminjamans->perPage() + $loop->iteration }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $peminjaman->arsip_id }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ date('d/m/Y', strtotime($peminjaman->borrowed)) }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    @if ($peminjaman->returned)
                                        {{ date('d/m/Y', strtotime($peminjaman->returned)) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="max-w-12 border border-gray-300 px-4 py-2 text-center">
                                    @if ($peminjaman->status === 'pending')
                                        <span
                                            class="rounded-sm bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                                            Pending
                                        </span>
                                    @elseif($peminjaman->status === 'approved')
                                        <span
                                            class="rounded-sm bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                            Borrowed
                                        </span>
                                    @else
                                        <span
                                            class="rounded-sm bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                            {{ ucfirst($peminjaman->status) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $peminjamans->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @else
            @include('shared.no-data')
        @endif
    </section>
@endsection
