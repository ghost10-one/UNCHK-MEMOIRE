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

        <!-- Livewire Styles -->
        @livewireStyles

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

        @livewireScripts
    </body>
</html>

<!DOCTYPE html>
<html lang="fr"
      x-data="appLayout()"
      :class="{ 'dark': darkMode }"
      class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MedRep') — Plateforme Délégués Médicaux</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

{{--
╔══════════════════════════════════════════════════════════════╗
║  SPRINT 4 · AB — Abibou Ndione                             ║
║  Carte #3 — Responsive mobile-first                        ║
║  Carte #5 — Dark mode toggle + localStorage                ║
║  Carte #6 — Accessibilité ARIA complète                    ║
║  COLLER DANS : resources/views/layouts/app.blade.php       ║
╚══════════════════════════════════════════════════════════════╝
--}}
<body class="h-full bg-surface-secondary dark:bg-dark-bg font-sans antialiased">

{{-- Overlay mobile (Carte #3 AB) --}}
<div x-show="sidebarOpen"
     x-transition:enter="transition-opacity duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-black/50 z-40 md:hidden"
     aria-hidden="true">
</div>

<div class="app-layout h-full">

    {{-- ═══════════════ SIDEBAR ═══════════════ --}}
    <aside id="sidebar"
           role="navigation"
           aria-label="Navigation principale"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
           class="sidebar fixed md:static inset-y-0 left-0 z-50 w-64
                  bg-white dark:bg-dark-surface
                  border-r border-surface-tertiary dark:border-dark-border
                  flex flex-col shadow-sm transition-transform duration-300">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 py-5 border-b border-surface-tertiary dark:border-dark-border flex-shrink-0">
            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-md flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <span class="text-lg font-bold text-content dark:text-dark-text font-heading">MedRep</span>
            {{-- Fermer sidebar mobile --}}
            <button @click="sidebarOpen = false"
                    class="ml-auto md:hidden p-1 rounded-lg text-content-tertiary hover:text-content focus-ring"
                    aria-label="Fermer le menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- User info --}}
        @auth
        <div class="px-4 py-3 border-b border-surface-tertiary dark:border-dark-border flex-shrink-0">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-surface-secondary dark:hover:bg-dark-bg transition-colors">
                <div class="w-9 h-9 bg-primary-100 dark:bg-primary-900/40 rounded-full flex items-center justify-center font-bold text-primary text-sm flex-shrink-0" aria-hidden="true">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-content dark:text-dark-text truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-content-tertiary dark:text-dark-muted">{{ auth()->user()->role ?? 'Délégué médical' }}</p>
                </div>
            </div>
        </div>
        @endauth

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin" aria-label="Menu principal">

            @php
                $links = [
                    ['route'=>'dashboard',         'label'=>'Tableau de bord',  'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['route'=>'calendrier.index',  'label'=>'Calendrier',        'icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                    ['route'=>'visites.index',     'label'=>'Visites',           'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ['route'=>'tournees.index',    'label'=>'Tournées',          'icon'=>'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7'],
                    ['route'=>'praticiens.index',  'label'=>'Praticiens',        'icon'=>'M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['route'=>'rapports.index',    'label'=>'Rapports',          'icon'=>'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ['route'=>'notifications.index','label'=>'Notifications',    'icon'=>'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9'],
                    ['route'=>'campagnes.index',   'label'=>'Campagnes',         'icon'=>'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z'],
                    ['route'=>'messages.index',    'label'=>'Messagerie',        'icon'=>'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
                    ['route'=>'parametres.index',  'label'=>'Paramètres',        'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                ];
            @endphp

            @foreach ($links as $link)
                @if (Route::has($link['route']))
                <a href="{{ route($link['route']) }}"
                   class="nav-link {{ request()->routeIs(explode('.', $link['route'])[0].'*') ? 'active' : '' }}"
                   aria-current="{{ request()->routeIs(explode('.', $link['route'])[0].'*') ? 'page' : 'false' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/>
                    </svg>
                    <span>{{ $link['label'] }}</span>
                    {{-- Badge notifications --}}
                    @if ($link['route'] === 'notifications.index' && auth()->check())
                        @php $unread = auth()->user()->unreadNotifications->count() @endphp
                        @if ($unread > 0)
                            <span class="ml-auto badge badge-danger text-xs" aria-label="{{ $unread }} non lues">{{ $unread }}</span>
                        @endif
                    @endif
                    {{-- Badge rapports --}}
                    @if ($link['route'] === 'visites.index' && auth()->check())
                        @php
                            try { $pending = auth()->user()->visites()->rapportsEnAttente()->count(); } catch(\Exception $e) { $pending = 0; }
                        @endphp
                        @if ($pending > 0)
                            <span class="ml-auto badge badge-warning text-xs" aria-label="{{ $pending }} rapports en attente">{{ $pending }}</span>
                        @endif
                    @endif
                </a>
                @endif
            @endforeach
        </nav>

        {{-- Déconnexion --}}
        <div class="p-3 border-t border-surface-tertiary dark:border-dark-border flex-shrink-0">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-danger hover:bg-danger-light dark:hover:bg-red-900/20 transition-colors focus-ring"
                        aria-label="Se déconnecter de MedRep">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    {{-- ═══════════════ MAIN ═══════════════ --}}
    <main class="main-content">

        {{-- Header --}}
        <header class="bg-white dark:bg-dark-surface border-b border-surface-tertiary dark:border-dark-border px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between gap-4 flex-shrink-0 shadow-xs"
                role="banner">

            <div class="flex items-center gap-3 min-w-0">
                {{-- Hamburger mobile (Carte #3 AB) --}}
                <button @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden p-2 rounded-xl text-content-tertiary hover:text-content hover:bg-surface-secondary transition-colors focus-ring"
                        :aria-expanded="sidebarOpen.toString()"
                        aria-controls="sidebar"
                        aria-label="Ouvrir le menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="min-w-0">
                    @hasSection('breadcrumb')
                        <nav aria-label="Fil d'Ariane" class="text-xs text-content-tertiary dark:text-dark-muted mb-0.5">
                            @yield('breadcrumb')
                        </nav>
                    @endif
                    <h1 class="text-lg font-bold text-content dark:text-dark-text truncate">
                        @yield('page-title', 'Tableau de bord')
                    </h1>
                </div>
            </div>

            {{-- Actions droite --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                @yield('header-actions')

                {{-- Recherche (cachée sur mobile) --}}
                <div class="hidden sm:block relative">
                    <label for="search-global" class="sr-only">Rechercher</label>
                    <input id="search-global" type="search" placeholder="Rechercher..."
                           class="w-44 lg:w-52 pl-8 pr-3 py-2 text-sm border border-surface-tertiary dark:border-dark-border rounded-xl bg-surface-secondary dark:bg-dark-bg text-content dark:text-dark-text placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                    <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-content-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>

                {{-- Dark mode toggle (Carte #5 AB) --}}
                <button @click="toggleDarkMode()"
                        class="w-9 h-9 flex items-center justify-center rounded-xl text-content-tertiary hover:text-content hover:bg-surface-secondary dark:hover:bg-dark-bg border border-surface-tertiary dark:border-dark-border transition-all focus-ring"
                        :aria-label="darkMode ? 'Passer en mode clair' : 'Passer en mode sombre'">
                    {{-- Soleil --}}
                    <svg x-show="darkMode" class="w-4 h-4 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    {{-- Lune --}}
                    <svg x-show="!darkMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                {{-- Menu utilisateur (Carte #4 AB — Alpine dropdown) --}}
                <div class="relative" x-data="dropdown()">
                    <button @click="toggle()"
                            @click.outside="close()"
                            @keydown.escape="close()"
                            x-ref="trigger"
                            class="w-9 h-9 bg-primary-100 dark:bg-primary-900/40 rounded-full flex items-center justify-center font-bold text-primary text-sm hover:ring-2 hover:ring-primary/30 transition-all focus-ring"
                            :aria-expanded="open.toString()"
                            aria-haspopup="menu"
                            aria-label="Menu utilisateur">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                    </button>

                    {{-- Dropdown (Carte #4 AB) --}}
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                         role="menu"
                         aria-label="Options utilisateur"
                         class="absolute right-0 top-full mt-2 w-52 bg-white dark:bg-dark-surface border border-surface-tertiary dark:border-dark-border rounded-2xl shadow-lg py-1.5 z-50">

                        <div class="px-4 py-2.5 border-b border-surface-tertiary dark:border-dark-border mb-1">
                            <p class="text-sm font-semibold text-content dark:text-dark-text">{{ auth()->user()->name ?? '' }}</p>
                            <p class="text-xs text-content-tertiary dark:text-dark-muted">{{ auth()->user()->email ?? '' }}</p>
                        </div>

                        @if (Route::has('parametres.index'))
                        <a href="{{ route('parametres.index') }}" role="menuitem"
                           class="flex items-center gap-3 px-4 py-2 text-sm text-content-secondary dark:text-dark-text hover:bg-surface-secondary dark:hover:bg-dark-bg transition-colors focus-ring">
                            <svg class="w-4 h-4 text-content-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Mon profil
                        </a>
                        @endif

                        <div class="border-t border-surface-tertiary dark:border-dark-border mt-1 pt-1">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" role="menuitem"
                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-danger hover:bg-danger-light dark:hover:bg-red-900/20 transition-colors focus-ring">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        {{-- Flash messages (Carte #4 AB — auto-disparaissants) --}}
        <div class="px-4 sm:px-6 lg:px-8 pt-4 space-y-2 flex-shrink-0" role="status" aria-live="polite">
            @foreach (['success'=>'green','error'=>'red','warning'=>'yellow','info'=>'blue'] as $type => $color)
                @if (session($type))
                    <div x-data="{ show: true }"
                         x-show="show"
                         x-init="setTimeout(() => show = false, 5000)"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         role="alert"
                         class="flex items-center gap-3 p-4 bg-{{ $color }}-50 dark:bg-{{ $color }}-900/20 border border-{{ $color }}-200 dark:border-{{ $color }}-800 rounded-2xl text-{{ $color }}-800 dark:text-{{ $color }}-200 text-sm animate-fade-in">
                        <span class="flex-1">{{ session($type) }}</span>
                        <button @click="show = false"
                                class="text-{{ $color }}-500 hover:text-{{ $color }}-700 flex-shrink-0"
                                aria-label="Fermer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Contenu --}}
        <div class="flex-1 overflow-y-auto scrollbar-thin px-4 sm:px-6 lg:px-8 py-6"
             id="main-content"
             role="main"
             tabindex="-1">
            @yield('content')
        </div>
    </main>
</div>

@stack('scripts')
</body>
</html>