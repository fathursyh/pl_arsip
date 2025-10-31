<!-- Edit Modal -->
<div id="editModal-{{ $arsip->id }}" role="dialog" tabindex="-1" aria-hidden="true"
    class="h-modal fixed left-0 right-0 top-0 z-50 hidden w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 inset-0 h-full"
    data-modal-backdrop="static">

    <div class="relative h-auto p-4 w-md">
        <!-- Modal content -->
        <div class="relative rounded-lg bg-white p-4 shadow sm:p-5">

            <!-- Modal header -->
            <div class="mb-4 flex items-center justify-between rounded-t border-b pb-4 sm:mb-5">
                <h3 class="text-lg font-semibold text-gray-900">Edit Arsip</h3>
                <button type="button"
                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                    data-modal-toggle="editModal-{{ $arsip->id }}">
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('admin.arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4 grid gap-4 sm:grid-cols">

                    <!-- Judul -->
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="title">Judul</label>
                        <input type="text" name="title" id="title"
                            value="{{ old('title', $arsip->title) }}"
                            class="focus:border-primary-600 focus:ring-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
                            required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="description">
                            Deskripsi
                        </label>
                        <textarea name="description" id="description" rows="4"
                            class="focus:border-primary-600 focus:ring-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900">{{ old('description', $arsip->description) }}</textarea>
                    </div>

                    <!-- File -->
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-900" for="path">Ganti File</label>
                        <input type="file" name="path" id="path"
                            class="focus:border-primary-600 focus:ring-primary-600 block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900">
                        @if ($arsip->original_name)
                            <p class="mt-2 text-sm text-gray-500">
                                File saat ini: <span class="font-semibold">{{ basename($arsip->original_name) }}</span>
                            </p>
                        @endif
                    </div>

                </div>

                <!-- Action buttons -->
                <div class="flex w-full justify-end gap-4 mt-8">
                    <button type="submit"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 inline-flex items-center rounded-lg px-5 py-2 text-sm font-medium text-white focus:outline-none focus:ring-4">
                        Simpan Perubahan
                    </button>

                    <button type="button"
                        class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center"
                        data-modal-toggle="editModal-{{ $arsip->id }}">
                        Batal
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
