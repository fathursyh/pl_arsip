@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Arsip')
@section('dashboard-title', 'Arsip')
@section('dashboard-desc', 'Lihat dan kelola seluruh data arsip')
@section('main')
    <section class="max-w-7xl">
        <!-- Search + Create Button -->
        <div class="mb-4 flex items-center justify-between">
            <div class="w-1/3">
                <input type="text" id="search" placeholder="Cari arsip..."
                    class="w-full rounded-lg border border-gray-300 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" />
            </div>

            <a href="#"
                class="flex gap-2 items-center rounded-lg bg-blue-600 px-4 py-2 font-medium text-white hover:bg-blue-700">
                <svg class="h-6 w-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14m-7 7V5" />
                </svg>
                <span>Tambah</span>
            </a>
        </div>

        <!-- Classic Table with Full Borders -->
        <div class="relative overflow-x-auto rounded-lg bg-white shadow">
            <table class="w-full border border-gray-300 text-left text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 py-2 text-center px-2">No</th>
                        <th class="border border-gray-300 px-4 py-2">Judul</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                        <th class="border border-gray-300 px-4 py-2">Diupload</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($arsips as $arsip)
                    <tr>
                        <td class="border border-gray-300 px-2 py-2 text-center"> {{ ($arsips->currentPage() - 1) * $arsips->perPage() + $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $arsip->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $arsip->description }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ date('d/m/Y', $arsip->createdAt) }}</td>
                        <td class="border border-gray-300 py-2 text-center px-2">

                            <div class="flex justify-center gap-3">
                                <button class="rounded-full bg-blue-100 hover:bg-blue-200 p-2 text-blue-600 hover:text-blue-800"
                                    title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 3.487l3.651 3.651a1.5 1.5 0 010 2.121l-9.546 9.546a4.5 4.5 0 01-1.897 1.125l-3.273.936a.75.75 0 01-.927-.927l.936-3.273a4.5 4.5 0 011.125-1.897l9.546-9.546a1.5 1.5 0 012.121 0z" />
                                    </svg>
                                </button>
                                <button class="text-red-600 bg-red-100 hover:bg-red-200 p-2 rounded-full hover:text-red-800" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084A2.25 2.25 0 015.84 19.673L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .563c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.02-2.09 2.201v.916" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
                {{  $arsips->links('vendor.pagination.tailwind')}}
        </div>
    </section>
@endsection
