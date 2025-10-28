@props(['message', 'type'])
@php
    $style = match ($type) {
        'success' => 'p-4 mb-4 text-sm text-green-800 bg-green-50',
        'danger' => 'p-4 mb-4 text-sm text-red-800 bg-red-50',
        'warning' => 'p-4 mb-4 text-sm text-yellow-800 bg-yellow-50',
        'info' => 'p-4 mb-4 text-sm text-blue-800 bg-blue-50',
    };
@endphp
<div id="alert" class="{{ $style }} fixed top-0 z-40 w-screen text-center" role="alert">
    <span class="font-medium">
        @switch($type)
            @case('danger')
                Terjadi Kesalahan!
            @break

            @case('success')
                Berhasil!
            @break

            @case('warning')
                Perhatian!
            @break

            @default
                Info!
        @endswitch
    </span>
    {{ $message }}
</div>

<script>
    const alert = document.getElementById('alert');
    const timer = setTimeout(() => {
        alert.style.display = 'none';
        clearTimeout(timer);
    }, 3000);
</script>
