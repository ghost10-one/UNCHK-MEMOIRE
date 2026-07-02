<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Sama-Sante') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-gradient-to-br from-blue-50 via-slate-50 to-blue-100/40 flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="w-full max-w-md bg-white shadow-xl shadow-blue-900/5 rounded-3xl p-8 sm:p-10 border border-slate-100/80">
            <!-- Header Logo -->
            <div class="flex justify-center items-center gap-3 mb-8">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-extrabold text-2xl shadow-lg shadow-blue-500/30">
                    +
                </div>
                <span class="text-3xl font-extrabold tracking-tight text-slate-900">Sama-Sante</span>
            </div>

            <!-- Content -->
            {{ $slot }}
        </div>

    </body>
</html>
