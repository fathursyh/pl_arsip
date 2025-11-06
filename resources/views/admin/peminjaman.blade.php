@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Peminjaman')
@section('dashboard-title', 'Peminjaman')
@section('dashboard-desc', 'Lihat dan kelola seluruh data peminjaman')
@section('main')
    <x-delete-modal />
    <section class="max-w-7xl">
        <!-- Search + Create Button -->
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
                            placeholder="Cari berdasarkan judul" value="{{ request()->query('search') }}" />
                        <button type="submit"
                            class="absolute bottom-2.5 end-2.5 rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">Cari</button>
                    </div>
                </form>
            </div>
            @include('admin.peminjaman.tabs')
        </div>
        @if (count($peminjamans) > 0)
            <div class="relative min-h-[50vh] overflow-x-auto rounded-lg pb-32">
                <table class="w-full border border-gray-300 text-left text-sm text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-2 py-2 text-center">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Arsip</th>
                            <th class="border border-gray-300 px-4 py-2">Peminjam</th>
                            <th class="border border-gray-300 px-4 py-2">Dipinjam</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">status</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($peminjamans as $peminjaman)
                            <tr class="hover:bg-gray-100">
                                <td class="max-w-32 border border-gray-300 px-4 py-2">
                                    {{ $peminjaman->id }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $peminjaman->arsip->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $peminjaman->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ date('d/m/y', strtotime($peminjaman->borrowed)) }}
                                </td>
                                <td class="max-w-12 border border-gray-300 px-4 py-2 text-center">
                                    @if ($peminjaman->status === 'pending')
                                        <span
                                            class="rounded-sm bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">Pending</span>
                                    @else
                                        <span
                                            class="rounded-sm bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Approved</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-2 py-2">
                                    <button id="action" data-dropdown-toggle="action-{{ $loop->iteration }}"
                                        class="flex w-full items-center justify-center rounded-lg p-0.5 text-center text-sm font-medium text-gray-500 hover:text-gray-800 focus:outline-none"
                                        type="button">
                                        <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div id="action-{{ $loop->iteration }}"
                                        class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="action">
                                            <li>
                                                <button class="block w-full px-4 py-2 text-left hover:bg-gray-100"
                                                    data-modal-target="editModal-{{ $peminjaman->id }}"
                                                    data-modal-toggle="editModal-{{ $peminjaman->id }}">
                                                    Edit
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $peminjamans->links('vendor.pagination.tailwind') }}
            </div>
        @else
            @include('shared.no-data')
        @endif
    </section>
@endsection
