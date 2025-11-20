@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Pengguna')
@section('dashboard-title', 'Manajemen Pengguna')
@section('dashboard-desc', 'Kelola data pengguna, peran, dan divisi')

@section('main')
    <section class="max-w-7xl">
        <!-- Search + Create Button -->
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
                            placeholder="Cari NIP atau Nama Pengguna" value="{{ request()->query('search') }}" />
                        <button type="submit"
                            class="absolute bottom-2.5 end-2.5 rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            {{-- Create Button (Redirects to Create Page) --}}
            <a href="{{ route('users.create') }}"
               class="flex items-center gap-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
               <svg class="h-3.5 w-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
               </svg>
               Tambah Pengguna
            </a>
        </div>

        @if ($users->count() > 0)
            {{-- Delete Modal Component --}}
            <x-confirm-modal method="DELETE" confirmText="Hapus" buttonName="deleteModal" />

            <div class="relative min-h-[50vh] overflow-x-auto rounded-lg pb-12">
                <table class="w-full border border-gray-300 text-left text-sm text-gray-700">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-2 py-2 text-center">No</th>
                            <th class="border border-gray-300 px-4 py-2">NIP</th>
                            <th class="border border-gray-300 px-4 py-2">Nama</th>
                            <th class="border border-gray-300 px-4 py-2">Divisi</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Role</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-2 py-2 text-center">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 font-medium text-gray-900">
                                    {{ $user->nip }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $user->name }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 capitalize">
                                    {{ $user->division ?? '-' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 text-center capitalize">
                                    @if ($user->role === 'admin')
                                        <span class="rounded-sm bg-purple-100 px-2.5 py-0.5 text-xs font-medium text-purple-800">
                                            Admin
                                        </span>
                                    @else
                                        <span class="rounded-sm bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                            User
                                        </span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-2 py-2">
                                    <button id="action" data-dropdown-toggle="action-{{ $loop->iteration }}"
                                        class="flex w-full items-center justify-center rounded-lg p-0.5 text-center text-sm font-medium text-gray-500 hover:text-gray-800 focus:outline-none"
                                        type="button">
                                        <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div id="action-{{ $loop->iteration }}"
                                        class="z-10 hidden w-44 divide-y divide-gray-100 rounded bg-white shadow">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="action">
                                            <li>
                                                {{-- Edit Button (Redirects to Edit Page) --}}
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                   class="block w-full px-4 py-2 text-left hover:bg-gray-100">
                                                    Edit
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="py-1 text-red-600">
                                            {{-- Delete Button (Triggers Modal) --}}
                                            <button class="block w-full px-4 py-2 text-left hover:bg-gray-100"
                                                type="button" data-modal-target="deleteModal"
                                                data-modal-toggle="deleteModal"
                                                data-target-DELETE="{{ route('users.destroy', $user->id) }}"
                                                data-name-target="Yakin ingin menghapus user: {{ $user->name }}?">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $users->appends(request()->query())->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @else
            @include('shared.no-data')
        @endif
    </section>
@endsection
