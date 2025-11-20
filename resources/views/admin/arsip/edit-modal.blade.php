<!-- Edit Modal -->
<div id="editModal-{{ $arsip->id }}" role="dialog" tabindex="-1" aria-hidden="true"
    class="h-modal fixed inset-0 left-0 right-0 top-0 z-50 hidden h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60"
    data-modal-backdrop="static">

    <div class="w-md relative h-auto p-4">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white p-4 shadow sm:p-5">

            <!-- Modal header -->
            <div class="mb-4 flex items-center justify-between rounded-t border-b pb-4 sm:mb-5">
                <h3 class="text-lg font-semibold text-gray-900">Edit Arsip</h3>
                <button type="button"
                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                    data-modal-toggle="editModal-{{ $arsip->id }}" onclick="clearForm()">
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('arsip.update', $arsip->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="sm:grid-cols mb-4 grid gap-4">

                    {{-- Nomor Risalah --}}
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="nomor_risalah">Nomor
                            Risalah</label>
                        <input type="text" name="nomor_risalah" id="nomor_risalah"
                            value="{{ old('nomor_risalah', $arsip->nomor_risalah) }}"
                            class="@error('nomor_risalah') border-red-500 focus:ring-red-500 focus:border-red-500
                                @else border-gray-300 focus:ring-primary-600 focus:border-primary-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900"
                            placeholder="Masukkan nomor risalah" required>
                        @error('nomor_risalah')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pemohon --}}
                    <div class="sm:col-span-2">
                        <label for="pemohon" class="mb-2 block text-sm font-medium text-gray-900">Pemohon</label>
                        <input type="text" id="pemohon" name="pemohon"
                            value="{{ old('pemohon', $arsip->pemohon) }}"
                            class="@error('pemohon') border-red-500 focus:ring-red-500 focus:border-red-500
                                @else border-gray-300 focus:ring-primary-600 focus:border-primary-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900"
                            placeholder="Masukkan nama pemohon" required>
                        @error('pemohon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Lelang --}}
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="jenis_lelang">Jenis
                            Lelang</label>
                        <select name="jenis_lelang" id="jenis_lelang"
                            class="@error('jenis_lelang') border-red-500 focus:ring-red-500 focus:border-red-500
                                @else border-gray-300 focus:ring-primary-600 focus:border-primary-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900"
                            required>
                            <option value="">Pilih jenis lelang</option>
                            <option value="jenis1"
                                {{ old('jenis_lelang', $arsip->jenis_lelang) == 'jenis1' ? 'selected' : '' }}>Jenis 1
                            </option>
                            <option value="jenis2"
                                {{ old('jenis_lelang', $arsip->jenis_lelang) == 'jenis2' ? 'selected' : '' }}>Jenis 2
                            </option>
                        </select>
                        @error('jenis_lelang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Uraian Barang --}}
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="uraian_barang">Uraian
                            Barang</label>
                        <textarea name="uraian_barang" rows="4" id="uraian_barang"
                            class="@error('uraian_barang') border-red-500 focus:ring-red-500 focus:border-red-500
                                @else border-gray-300 focus:ring-primary-600 focus:border-primary-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900"
                            placeholder="Masukkan uraian barang" required>{{ old('uraian_barang', $arsip->uraian_barang) }}</textarea>
                        @error('uraian_barang')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="status">Status</label>
                        <select name="status" id="status"
                            class="@error('status') border-red-500 focus:ring-red-500 focus:border-red-500
                                @else border-gray-300 focus:ring-primary-600 focus:border-primary-600 @enderror block w-full rounded-lg border bg-gray-50 p-2.5 text-sm text-gray-900">
                            <option value="1" {{ old('status', $arsip->status) == 1 ? 'selected' : '' }}>Tersedia
                            </option>
                            <option value="0" {{ old('status', $arsip->status) == 0 ? 'selected' : '' }}>Dipinjam
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Buttons -->
                <div class="mt-8 flex w-full justify-end gap-4">
                    <button type="submit"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 rounded-lg px-5 py-2 text-sm font-medium text-white focus:ring-4">
                        Simpan Perubahan
                    </button>

                    <button type="button"
                        class="rounded-lg border border-gray-800 px-8 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-900 hover:text-white focus:ring-4 focus:ring-gray-300"
                        data-modal-toggle="editModal-{{ $arsip->id }}" onclick="clearForm()">
                        Batal
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    function clearForm() {
        const url = new URL(window.location);
        url.searchParams.delete('edit');
        window.history.pushState({}, '', url);
        document.location.reload()
    }
</script>

@if ($errors->any() && request()->query('edit') && $arsip->nomor_risalah === old('nomor_risalah'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const id = @json($arsip->id);
            const modalElement = document.getElementById(`editModal-${id}`);
            if (modalElement) {
                const modal = new Modal(modalElement);
                if (modal.isHidden()) modal.show();
            }
        });
    </script>
@endif

@if (request()->query('edit') && !$errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const id = @json($arsip->id);
            const modalElement = document.getElementById(`editModal-${id}`);
            if (modalElement) {
                const modal = new Modal(modalElement);
                if (modal.isHidden()) {
                    const url = new URL(window.location);
                    url.searchParams.delete('edit');
                    window.history.pushState({}, '', url);
                    document.location.reload()
                };
            }
        });
    </script>
@endif
