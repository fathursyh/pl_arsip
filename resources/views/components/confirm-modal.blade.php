@props(['method', 'buttonName', 'confirmText'])
@php
    $style = match($method) {
        'DELETE', => 'bg-red-600 hover:bg-red-700',
        'PUT', => 'bg-blue-600 hover:bg-blue-700',
    }
@endphp
<div id="{{ $buttonName }}" tabindex="-1"
    class="fixed inset-0 z-50 hidden h-full max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden bg-black/70">

    <div class="relative max-h-full w-full max-w-md p-4">
        <div class="relative rounded-lg bg-white shadow-sm">

            <!-- Close Button -->
            <button type="button"
                class="absolute right-3 top-3 inline-flex h-8 w-8 items-center justify-center rounded-lg text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900"
                data-modal-hide="{{ $buttonName }}">
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <!-- Content -->
            <div class="p-5 text-center">
                <svg class="mx-auto mb-4 h-12 w-12 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

                <h3 class="mb-5 text-lg font-normal text-gray-600">
                    <span id="item-name-{{ $method }}"></span>
                </h3>

                <form id="form-{{ $method }}" method="POST" class="inline">
                    @csrf
                    @method($method)
                    {{ $slot }}
                    <button type="submit" class="rounded-lg px-4 py-2 text-white {{ $style }}">
                        {{ $confirmText ?? 'OK' }}
                    </button>
                </form>


                <button data-modal-hide="{{ $buttonName }}" type="button"
                    class="ml-3 rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100">
                    Batal
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('[data-modal-toggle]');
        const form = document.getElementById('form-' + @js($method));

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const url = btn.getAttribute('data-target-' + @js($method));
                const name = btn.getAttribute('data-name-target');
                document.getElementById('item-name-' + @js($method)).innerHTML = name;
                form.setAttribute('action', url);
            });
        });
    });
</script>
