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
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
            <!-- Mobile Sidebar Backdrop -->
            <div x-show="sidebarOpen" 
                 x-transition.opacity 
                 @click="sidebarOpen = false" 
                 class="fixed inset-0 bg-gray-900/50 z-20 md:hidden" 
                 style="display: none;"></div>

            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col md:ml-64 transition-all duration-300">
                
                <!-- Header (Mobile Toggle & Top Actions) -->
                <header class="bg-white border-b border-gray-100 flex items-center justify-between h-20 px-6 sticky top-0 z-10">
                    <div class="flex items-center gap-4">
                        <!-- Mobile Menu Button (Hidden on md) -->
                        <button @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>
                        
                        @isset($header)
                            {{ $header }}
                        @else
                            <h1 class="text-2xl font-bold tracking-tight text-gray-900">Tableau de bord</h1>
                        @endisset
                    </div>

                    <div class="flex items-center gap-4">
                        <!-- Search -->
                        <div class="relative hidden sm:block">
                            <input type="text" placeholder="Rechercher..." class="w-64 rounded-lg border-gray-200 bg-gray-50 focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                        
                        <!-- Notification Bell -->
                        <button class="relative p-2 text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- Avatar Small -->
                        <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs sm:hidden">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-6">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </body>
</html>
