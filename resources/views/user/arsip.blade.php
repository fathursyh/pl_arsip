@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Peminjaman Arsip')
@section('dashboard-title', 'Daftar Arsip')
@section('dashboard-desc', 'Cari dan ajukan peminjaman arsip')

@section('main')
    <section class="max-w-7xl">
        <div class="mb-4 flex items-center justify-between gap-4">
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
                            placeholder="Cari berdasarkan nomor risalah" value="{{ request()->query('search') }}" />
                        <button type="submit"
                            class="absolute bottom-2.5 end-2.5 rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">Cari</button>
                    </div>
                </form>
            </div>
        </div>

        @if (count($arsips) > 0)
            <x-confirm-modal method="PUT" confirmText="Pinjam" buttonName="pinjamModal" />

            <div class="relative min-h-[50vh] overflow-x-auto rounded-lg pb-12">
                <table class="w-full border border-gray-300 text-left text-sm text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-2 py-2 text-center">No</th>
                            <th class="border border-gray-300 px-4 py-2">Nomor Risalah</th>
                            <th class="border border-gray-300 px-4 py-2">Pemohon</th>
                            <th class="border border-gray-300 px-4 py-2">Jenis Lelang</th>
                            <th class="border border-gray-300 px-4 py-2">Uraian Barang</th>
                            <th class="border border-gray-300 px-4 py-2">Dibuat</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($arsips as $arsip)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-2 py-2 text-center">
                                    {{ ($arsips->currentPage() - 1) * $arsips->perPage() + $loop->iteration }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->nomor_risalah }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->pemohon }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->jenis_lelang }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->uraian_barang }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->created_at->format('d/m/Y') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center capitalize">
                                    @if ($arsip->status)
                                        <span
                                            class="rounded-sm bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Available</span>
                                    @else
                                        <span
                                            class="rounded-sm bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">Borrowed</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-2 py-2 text-center">
                                    {{-- Action Button Logic --}}
                                    @if ($arsip->status)
                                        {{-- If Available, Show Pinjam Button --}}
                                        <button
                                            class="inline-flex items-center justify-center rounded-lg bg-blue-700 px-3 py-2 text-xs font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
                                            type="button" data-modal-target="pinjamModal" data-modal-toggle="pinjamModal"
                                            data-target-PUT="{{ route('user.peminjaman-arsip', $arsip->id) }}"
                                            data-name-target="Yakin ingin meminjam arsip dengan nomor risalah:  {{ $arsip->nomor_risalah }}?">
                                            Pinjam
                                        </button>
                                    @else
                                        {{-- If Borrowed, Show Disabled Button --}}
                                        <button disabled
                                            class="inline-flex cursor-not-allowed items-center justify-center rounded-lg bg-gray-300 px-3 py-2 text-xs font-medium text-gray-500">
                                            Pinjam
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $arsips->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @else
            @include('shared.no-data')
        @endif
    </section>
@endsection
