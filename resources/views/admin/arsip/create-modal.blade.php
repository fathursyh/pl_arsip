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
    class="h-modal fixed left-0 right-0 top-0 z-50 hidden w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black/60 inset-0 h-full" data-modal-backdrop="static">
    <div class="relative h-auto p-4 w-md">
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
            <form id="create-form" action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 grid gap-4 sm:grid-cols">
                    <div class="sm:col-span-2">
                        <label for="title" class="mb-2 block text-sm font-medium text-gray-900">Judul</label>
                        <input type="text" name="title" id="title"
                            class="focus:border-primary-600 focus:ring-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
                            placeholder="Masukkan judul arsip" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="sm:col-span-2">
                        <label for="description" class="mb-2 block text-sm font-medium text-gray-900">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="focus:border-primary-600 focus:ring-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900"
                            placeholder="Masukkan deskripsi arsip"></textarea>
                    </div>

                    <!-- File -->
                    <div class="sm:col-span-2">
                        <label for="path" class="mb-2 block text-sm font-medium text-gray-900">Upload File</label>
                        <input type="file" name="path" id="path"
                            class="focus:border-primary-600 focus:ring-primary-600 block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900">
                    </div>

                </div>

                <div class="flex w-full justify-end gap-4 mt-8">
                    <button type="submit"
                        class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 inline-flex items-center rounded-lg px-5 py-2 text-sm font-medium text-white focus:outline-none focus:ring-4">
                        <svg class="-ml-1 mr-1 h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Tambah Arsip
                    </button>
                    <button type="button" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-8 py-2.5 text-center" data-modal-toggle="createModal" onclick="clearForm()">Batal</button>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function clearForm() {
        document.getElementById('create-form').reset();
    }
</script>
