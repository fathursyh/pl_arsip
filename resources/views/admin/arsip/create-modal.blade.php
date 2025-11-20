<!-- Modal toggle -->
<div class="flex justify-center">
    <button id="createModalButton" data-modal-target="createModal" data-modal-toggle="createModal"
        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 flex items-center gap-2 rounded-lg px-5 py-3 text-center text-sm font-medium text-white focus:outline-none focus:ring-4"
        type="button">
        <svg class="h-4 w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 12h14m-7 7V5" />
        </svg>
        <span class="hidden md:block">Buat Arsip</span>
    </button>
</div>

<!-- Main modal -->
<div id="createModal" role="dialog" tabindex="-1" aria-hidden="true"
    class="h-modal fixed inset-0 left-0 right-0 top-0 z-50 hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60"
    data-modal-backdrop="static">

    <div class="w-md relative h-auto p-4">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white p-4 shadow sm:p-5">

            <!-- Modal header -->
            <div class="mb-4 flex items-center justify-between rounded-t border-b pb-4 sm:mb-5">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambah Arsip Baru
                </h3>

                <button type="button"
                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                    data-modal-toggle="createModal" onclick="clearForm()">
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form id="create-form" action="{{ route('arsip.store') }}" method="POST" novalidate>
                @csrf

                <div class="sm:grid-cols mb-4 grid gap-4">

                    {{-- Nomor Risalah --}}
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="nomor_risalah">Nomor Risalah</label>

                        <input type="text" name="nomor_risalah" id="nomor_risalah" value="{{ old('nomor_risalah') }}"
                            class="@error('nomor_risalah') border-red-500 focus:ring-red-500 focus:border-red-500
                                @else border-gray-300 focus:ring-primary-600 focus:border-primary-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900"
                            placeholder="Masukkan nomor risalah" required>

                        @error('nomor_risalah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pemohon --}}
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="pemohon">Pemohon</label>

                        <input type="text" name="pemohon" id="pemohon" value="{{ old('pemohon') }}"
                            class="@error('pemohon') border-red-500 focus:ring-red-500 focus:border-red-500
                                @else border-gray-300 focus:ring-primary-600 focus:border-primary-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900"
                            placeholder="Masukkan nama pemohon" required>

                        @error('pemohon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Lelang --}}
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="jenis_lelang">Jenis Lelang</label>

                        <select name="jenis_lelang" id="jenis_lelang"
                            class="@error('jenis_lelang') border-red-500 focus:ring-red-500 focus:border-red-500
                                @else border-gray-300 focus:ring-primary-600 focus:border-primary-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900"
                            required>
                            <option value="">Pilih jenis lelang</option>
                            <option value="jenis1" {{ old('jenis_lelang') == 'jenis1' ? 'selected' : '' }}>Jenis 1
                            </option>
                            <option value="jenis2" {{ old('jenis_lelang') == 'jenis2' ? 'selected' : '' }}>Jenis 2
                            </option>
                        </select>

                        @error('jenis_lelang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Uraian Barang --}}
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="uraian_barang">Uraian Barang</label>

                        <textarea name="uraian_barang" rows="4" id="uraian_barang"
                            class="@error('uraian_barang') border-red-500 focus:ring-red-500 focus:border-red-500
                                @else border-gray-300 focus:ring-primary-600 focus:border-primary-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900"
                            placeholder="Masukkan uraian barang" required>{{ old('uraian_barang') }}</textarea>

                        @error('uraian_barang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="mt-8 flex w-full justify-end gap-4">
                    <button type="submit"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 inline-flex items-center rounded-lg px-5 py-2 text-sm font-medium text-white focus:ring-4">
                        <svg class="-ml-1 mr-1 h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Tambah Arsip
                    </button>

                    <button type="button"
                        class="rounded-lg border border-gray-800 px-8 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-900 hover:text-white focus:ring-4 focus:ring-gray-300"
                        data-modal-toggle="createModal" onclick="clearForm()">
                        Batal
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function clearForm() {
        document.location.reload()
    }
</script>

@if ($errors->any() && !request()->query('edit'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modalElement = document.getElementById('createModal');
            if (modalElement) {
                const modal = new Modal(modalElement);
                if (modal.isHidden()) modal.show();
            }
        });
    </script>
@endif
