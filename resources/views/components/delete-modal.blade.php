<div id="deleteModal" tabindex="-1"
    class="fixed z-50 hidden h-full max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden inset-0 bg-black/70">

    <div class="relative w-full max-w-md max-h-full p-4">
        <div class="relative rounded-lg bg-white shadow-sm">

            <!-- Close Button -->
            <button type="button"
                class="absolute top-3 right-3 inline-flex h-8 w-8 items-center justify-center rounded-lg text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                data-modal-hide="deleteModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <!-- Content -->
            <div class="p-5 text-center">
                <svg class="mx-auto mb-4 h-12 w-12 text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <h3 class="mb-5 text-lg font-normal text-gray-600">
                   Yakin ingin menghapus
                    <span id="item-name"></span>?
                </h3>

                <form id="delete-form" method="POST" class="inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">
                        Hapus
                    </button>
                </form>

                <button data-modal-hide="deleteModal" type="button"
                    class="ml-3 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100">
                    Batal
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('[data-delete-target]');
        const form = document.getElementById('delete-form');

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const url = btn.getAttribute('data-delete-target');
                const name = btn.getAttribute('data-name-target');
                document.getElementById('item-name').innerHTML = name;
                form.setAttribute('action', url);
            });
        });
    });
</script>
