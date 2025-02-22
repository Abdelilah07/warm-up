<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Books Manager') }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="antialiased bg-gradient-to-br from-gray-50 to-gray-200">
    <div class="relative min-h-screen flex items-center justify-center sm:items-center py-4 sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <!-- You can add your logo here -->
                <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 text-center">
                    <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-6">
                        Books Manager
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">
                        Your personal library management system
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="{{ route('login') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 transition md:text-lg">
                            Sign in to your account
                        </a>
                        <a href="{{ route('register') }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-red-600 bg-white hover:bg-gray-50 border-red-600 transition md:text-lg">
                            Create new account
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>