<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My App</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Books manager</h1>
            <div class="space-x-4">
                <a href="/sign-in" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">Sign-in</a>
                <a href="/register" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">Register</a>
            </div>
        </div>
    </div>
</body>

</html>