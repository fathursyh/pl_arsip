<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Arsip</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="h-screen w-screen flex flex-col justify-center items-center">
        <h1>Landing Page</h1>
        <a href="{{ route('login') }}">Login</a>
    </div>
</body>

</html>
