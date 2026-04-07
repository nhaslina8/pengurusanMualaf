<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pengurusan Muallaf') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC]">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation Header -->
            <header class="bg-white dark:bg-[#1b1b18] shadow-sm">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-[#1b1b18] dark:text-white">
                            <a href="{{ route('muallafs.index') }}">Pengurusan Muallaf</a>
                        </h1>
                        <nav class="space-x-4">
                            <a href="{{ route('muallafs.index') }}" class="text-[#1b1b18] dark:text-white hover:text-gray-700 dark:hover:text-gray-300 font-medium">Senarai Muallaf</a>
                        </nav>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-[#1b1b18] border-t border-gray-200 dark:border-gray-700 mt-auto">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center text-sm text-gray-600 dark:text-gray-400">
                    <p>&copy; 2026 Sistem Pengurusan Muallaf. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
