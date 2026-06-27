<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="appLayout()"
      :class="{ 'dark': darkMode }"
      class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'MedRep') }} — Plateforme Délégués Médicaux</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="h-full bg-surface-secondary dark:bg-dark-bg font-sans antialiased">

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

    <aside id="sidebar"
           role="navigation"
           aria-label="Navigation principale"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
           class="sidebar fixed md:static inset-y-0 left-0 z-50 w-64
                  bg-white dark:bg-dark-surface
                  border-r border-surface-tertiary dark:border-dark-border
                  flex flex-col shadow-sm transition-transform duration-300">

        <div class="flex items-center gap-3 px-5 py-5 border-b border-surface-tertiary dark:border-dark-border flex-shrink-0">
            <div class="w-9 h-9 bg-primary rounded-xl flex items-center justify-center shadow-md flex-shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <span class="text-lg font-bold text-content dark:text-dark-text font-heading">MedRep</span>
            <button @click="sidebarOpen = false"
                    class="ml-auto md:hidden p-1 rounded-lg text-content-tertiary hover:text-content focus-ring"
                    aria-label="Fermer le menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        @auth
        <div class="px-4 py-3 border-b border-surface-tertiary dark:border-dark-border flex-shrink-0">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-surface-secondary dark:hover:bg-dark-bg transition-colors">
                <div class="w-9 h-9 bg-primary-100 dark:bg-primary-900/40 rounded-full flex items-center justify-center font-bold text-primary text-sm flex-shrink-0" aria-hidden="true">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-content dark:text-dark-text truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-content-tertiary dark:text-dark-muted capitalize">{{ auth()->user()->getRoleNames()->first() ?? 'Utilisateur' }}</p>
                </div>
            </div>
        </div>
        @endauth

        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin" aria-label="Menu principal">
            @php
                $user = auth()->user();
                $dashboardRoute = 'dashboard';

                if ($user?->hasRole(\App\Models\User::ROLE_ADMIN)) {
                    $dashboardRoute = 'admin.dashboard';
                } elseif ($user?->hasRole(\App\Models\User::ROLE_MANAGER)) {
                    $dashboardRoute = 'manager.dashboard';
                } elseif ($user?->hasRole(\App\Models\User::ROLE_DELEGATE)) {
                    $dashboardRoute = 'delegate.dashboard';
                } elseif ($user?->hasRole(\App\Models\User::ROLE_PRO_SANTÉ)) {
                    $dashboardRoute = 'praticien.dashboard';
                }

                $icons = [
                    'home' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                    'calendar' => 'M8 7V3m8 4V3M5 11h14M5 5h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z',
                    'visits' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                    'users' => 'M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 11-6 0 3 3 0 016 0z',
                    'reports' => 'M9 17v-2m3 2v-4m3 4v-6M5 3h10l4 4v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z',
                    'campaigns' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
                    'map' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7',
                    'bell' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0m6 0H9',
                    'profile' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                    'settings' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.607 2.296.07 2.572-1.065zM15 12a3 3 0 11-6 0 3 3 0 016 0z',
                ];

                $links = [
                    ['route' => $dashboardRoute, 'label' => 'Tableau de bord', 'icon' => $icons['home']],
                ];

                if ($user?->hasAnyRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_MANAGER])) {
                    $spacePrefix = $user?->hasRole(\App\Models\User::ROLE_ADMIN) ? 'admin' : 'manager';
                    $links = array_merge($links, [
                        ['route' => $spacePrefix.'.calendar', 'label' => 'Calendrier', 'icon' => $icons['calendar']],
                        ['route' => 'visites.index', 'label' => 'Visites', 'icon' => $icons['visits']],
                        ['route' => 'praticiens.index', 'label' => 'Praticiens', 'icon' => $icons['users']],
                        ['route' => $spacePrefix.'.reports', 'label' => 'Rapports', 'icon' => $icons['reports']],
                        ['route' => $spacePrefix.'.notifications', 'label' => 'Notifications', 'icon' => $icons['bell'], 'badge' => 3],
                        ['route' => 'campaigns.index', 'label' => 'Campagnes', 'icon' => $icons['campaigns']],
                        ['route' => $spacePrefix.'.analytics', 'label' => 'Analytics', 'icon' => $icons['reports']],
                    ]);
                } elseif ($user?->hasRole(\App\Models\User::ROLE_DELEGATE)) {
                    $links = array_merge($links, [
                        ['route' => 'visites.index', 'label' => 'Visites', 'icon' => $icons['visits']],
                        ['route' => 'praticiens.index', 'label' => 'Carte & Tournées', 'icon' => $icons['map']],
                        ['route' => 'campaigns.index', 'label' => 'Campagnes', 'icon' => $icons['campaigns']],
                    ]);
                } elseif ($user?->hasRole(\App\Models\User::ROLE_PRO_SANTÉ)) {
                    $links = array_merge($links, [
                        ['route' => 'visites.index', 'label' => 'Mes visites', 'icon' => $icons['visits']],
                        ['route' => 'profile.edit', 'label' => 'Mon profil', 'icon' => $icons['profile']],
                    ]);
                }

                $links[] = ['route' => 'profile.edit', 'label' => 'Paramètres', 'icon' => $icons['settings']];
            @endphp

            @foreach ($links as $link)
                @if (Route::has($link['route']))
                @php
                    $routeRoot = explode('.', $link['route'])[0];
                    $resourceRoute = in_array($routeRoot, ['visites', 'praticiens', 'campaigns', 'tournees'], true);
                    $active = request()->routeIs($link['route']) || ($resourceRoute && request()->routeIs($routeRoot.'.*'));
                @endphp
                <a href="{{ route($link['route']) }}"
                   class="nav-link {{ $active ? 'active' : '' }}"
                   aria-current="{{ $active ? 'page' : 'false' }}">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/>
                    </svg>
                    <span>{{ $link['label'] }}</span>
                    @if (! empty($link['badge']))
                        <span class="ml-auto inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-danger px-1.5 text-[10px] font-bold text-white">
                            {{ $link['badge'] }}
                        </span>
                    @endif
                </a>
                @endif
            @endforeach
        </nav>

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

    <main class="main-content">

        <header class="bg-white dark:bg-dark-surface border-b border-surface-tertiary dark:border-dark-border px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between gap-4 flex-shrink-0"
                role="banner">

            <div class="flex items-center gap-3 min-w-0 md:w-12">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="md:hidden p-2 rounded-xl text-content-tertiary hover:text-content hover:bg-surface-secondary transition-colors focus-ring"
                        :aria-expanded="sidebarOpen.toString()"
                        aria-controls="sidebar"
                        aria-label="Ouvrir le menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            <div class="flex min-w-0 flex-1 items-center justify-center">
                @yield('header-actions')

                <div class="hidden sm:block relative w-full max-w-2xl">
                    <label for="search-global" class="sr-only">Rechercher</label>
                    <input id="search-global" type="search" placeholder="Rechercher..."
                           class="w-full pl-10 pr-4 py-2.5 text-sm border border-surface-tertiary dark:border-dark-border rounded-xl bg-white dark:bg-dark-bg text-content dark:text-dark-text placeholder-content-tertiary focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-content-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <div class="flex items-center gap-3 flex-shrink-0">
                <button type="button"
                        @click="toggleDarkMode()"
                        class="w-10 h-10 flex items-center justify-center rounded-xl text-content-secondary hover:text-content hover:bg-surface-secondary dark:hover:bg-dark-bg transition-all focus-ring"
                        :aria-label="darkMode ? 'Passer en mode clair' : 'Passer en mode sombre'">
                    <svg x-show="darkMode" class="w-5 h-5 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-13.66l-.7.7M4.04 19.96l-.7.7M21 12h-1M4 12H3m16.96 7.96l-.7-.7M4.04 4.04l-.7-.7M12 7a5 5 0 100 10 5 5 0 000-10z"/>
                    </svg>
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                    </svg>
                </button>

                @php
                    $notificationRoute = auth()->user()?->hasRole(\App\Models\User::ROLE_ADMIN) ? 'admin.notifications' : (auth()->user()?->hasRole(\App\Models\User::ROLE_MANAGER) ? 'manager.notifications' : null);
                @endphp
                <a href="{{ $notificationRoute && Route::has($notificationRoute) ? route($notificationRoute) : '#' }}"
                   class="relative w-10 h-10 flex items-center justify-center rounded-xl text-content-secondary hover:text-content hover:bg-surface-secondary dark:hover:bg-dark-bg transition-all focus-ring"
                   aria-label="Notifications">
                    <span class="absolute right-2.5 top-2.5 h-2 w-2 rounded-full bg-danger"></span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0m6 0H9"/>
                    </svg>
                </a>

                @auth
                <div class="relative" x-data="dropdown()">
                    <button @click="toggle()"
                            @click.outside="close()"
                            @keydown.escape="close()"
                            x-ref="trigger"
                            class="w-9 h-9 bg-primary-100 dark:bg-primary-900/40 rounded-full flex items-center justify-center font-bold text-primary text-sm hover:ring-2 hover:ring-primary/30 transition-all focus-ring"
                            :aria-expanded="open.toString()"
                            aria-haspopup="menu"
                            aria-label="Menu utilisateur">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </button>

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
                            <p class="text-sm font-semibold text-content dark:text-dark-text">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-content-tertiary dark:text-dark-muted">{{ auth()->user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}" role="menuitem"
                           class="flex items-center gap-3 px-4 py-2 text-sm text-content-secondary dark:text-dark-text hover:bg-surface-secondary dark:hover:bg-dark-bg transition-colors focus-ring">
                            <svg class="w-4 h-4 text-content-tertiary" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Mon profil
                        </a>

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
                @endauth
            </div>
        </header>

        <div class="px-4 sm:px-6 lg:px-8 pt-4 space-y-2 flex-shrink-0" role="status" aria-live="polite">
            @foreach (['success' => 'success', 'error' => 'danger', 'warning' => 'warning', 'info' => 'secondary'] as $type => $variant)
                @if (session($type))
                    <x-alert :type="$variant" dismissible>{{ session($type) }}</x-alert>
                @endif
            @endforeach
        </div>

        <div class="flex-1 overflow-y-auto scrollbar-thin px-4 sm:px-6 lg:px-8 py-6"
             id="main-content"
             role="main"
             tabindex="-1">
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset
        </div>
    </main>
</div>

@livewireScripts
@stack('scripts')
</body>
</html>
