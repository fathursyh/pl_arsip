@extends('layouts.dashboard-layout')

@section('title', 'Dashboard | Arsip')
@section('dashboard-title', 'Arsip Lelang')
@section('dashboard-desc', 'Lihat dan kelola seluruh data arsip')
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
                            placeholder="Cari berdasarkan nomor risalah" value="{{ request()->query('search') }}" />
                        <button type="submit"
                            class="absolute bottom-2.5 end-2.5 rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">Cari</button>
                    </div>
                </form>
            </div>
            <div class="flex gap-2">
                <button id="upload-csv"
                    class="flex gap-1 items-center bg-neutral-primary border border-green-700 text-green-700 hover:bg-gray-800 hover:text-white font-medium leading-5 rounded-lg text-sm px-4 focus:outline-none"
                    type="button">
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm1.018 8.828a2.34 2.34 0 0 0-2.373 2.13v.008a2.32 2.32 0 0 0 2.06 2.497l.535.059a.993.993 0 0 0 .136.006.272.272 0 0 1 .263.367l-.008.02a.377.377 0 0 1-.018.044.49.49 0 0 1-.078.02 1.689 1.689 0 0 1-.297.021h-1.13a1 1 0 1 0 0 2h1.13c.417 0 .892-.05 1.324-.279.47-.248.78-.648.953-1.134a2.272 2.272 0 0 0-2.115-3.06l-.478-.052a.32.32 0 0 1-.285-.341.34.34 0 0 1 .344-.306l.94.02a1 1 0 1 0 .043-2l-.943-.02h-.003Zm7.933 1.482a1 1 0 1 0-1.902-.62l-.57 1.747-.522-1.726a1 1 0 0 0-1.914.578l1.443 4.773a1 1 0 0 0 1.908.021l1.557-4.773Zm-13.762.88a.647.647 0 0 1 .458-.19h1.018a1 1 0 1 0 0-2H6.647A2.647 2.647 0 0 0 4 13.647v1.706A2.647 2.647 0 0 0 6.647 18h1.018a1 1 0 1 0 0-2H6.647A.647.647 0 0 1 6 15.353v-1.706c0-.172.068-.336.19-.457Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="hidden md:block">Upload CSV</span>
                </button>
                @include('admin.arsip.create-modal')
            </div>
        </div>
        @if (count($arsips) > 0)
            <x-confirm-modal method="DELETE" confirmText="Hapus" buttonName="deleteModal" />
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
                            @include('admin.arsip.edit-modal', ['arsip' => $arsip])

                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-2 py-2 text-center">
                                    {{ ($arsips->currentPage() - 1) * $arsips->perPage() + $loop->iteration }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->nomor_risalah }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->pemohon }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->jenis_lelang }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->uraian_barang }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $arsip->created_at->format('d/m/Y') }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center capitalize">
                                    @if ($arsip->status)
                                        <span
                                            class="rounded-sm bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">Available</span>
                                    @else
                                        <span
                                            class="rounded-sm bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">Borrowed</span>
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
                                                    data-modal-target="editModal-{{ $arsip->id }}"
                                                    data-modal-toggle="editModal-{{ $arsip->id }}"
                                                    onclick="toggleEdit()">
                                                    Edit
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="py-1 text-red-600">
                                            <button class="block w-full px-4 py-2 text-left hover:bg-gray-100"
                                                type="button" data-modal-target="deleteModal"
                                                data-modal-toggle="deleteModal"
                                                data-target-DELETE="{{ route('arsip.destroy', $arsip->id) }}"
                                                data-name-target="Yakin ingin menghapus arsip dengan nomor risalah:  {{ $arsip->nomor_risalah }}?">
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
                    {{ $arsips->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @else
            @include('shared.no-data')
        @endif
    </section>

    <script>
        function toggleEdit() {
            const url = new URL(window.location);
            url.searchParams.set('edit', '1');
            window.history.pushState({}, '', url);
        }
    </script>

@endsection
