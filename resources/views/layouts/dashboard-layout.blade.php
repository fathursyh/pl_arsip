<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @section('title')
            Dashboard
        @show
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('partials.sidebar')
    <div class="flex h-screen flex-col overflow-y-auto px-8 py-4 sm:ml-64 lg:py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">@yield('dashboard-title')</h1>
            <p class="mt-1 text-gray-600">@yield('dashboard-desc')</p>
        </div>
        @yield('main')
    </div>
    @if (session('alert'))
        <x-alert :type="session('type')" :message="session('alert')" />
    @endif
</body>

</html>
