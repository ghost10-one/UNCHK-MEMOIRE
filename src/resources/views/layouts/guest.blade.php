<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MedRep') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8 border border-gray-100">
            <!-- Header Logo -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-xl shadow-sm">
                    +
                </div>
                <span class="text-2xl font-bold tracking-tight text-gray-900">MedRep</span>
            </div>

            <!-- Content -->
            {{ $slot }}
        </div>

    </body>
</html>
