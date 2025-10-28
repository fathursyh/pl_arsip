<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @section('title')
            Authentication
        @show
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @if ($errors->any())
        @error('error')
            <x-alert :message="$message" type="danger" />
        @enderror
    @endif
    @yield('main')
    @if (session('alert'))
        <x-alert :type="session('type')" :message="session('alert')" />
    @endif
</body>

</html>
