<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="appLayout()"
      :class="{ 'dark': darkMode }"
      class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Sama-Sante') }} — Plateforme Délégués Médicaux</title>
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

        <!-- Logo -->
        <div class="flex items-center justify-between px-6 h-20 border-b border-slate-100/80 flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center font-bold text-2xl shadow-md shadow-blue-500/20">
                    +
                </div>
                <span class="text-2xl font-extrabold text-slate-900 tracking-tight">Sama-Sante</span>
            </a>
            
            <!-- Close Sidebar Button (Mobile) -->
            <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-slate-600 p-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        @auth
        <!-- User Profile Mini -->
        <div class="p-5 border-b border-slate-100/80 flex items-center gap-3 flex-shrink-0">
            <div class="w-11 h-11 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-base shadow-sm">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
            </div>
            <div class="overflow-hidden">
                <div class="text-sm font-bold text-slate-900 truncate tracking-tight">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                <div class="text-xs font-medium text-slate-500 truncate capitalize">{{ Auth::user()->roles->first()->name ?? Auth::user()->role ?? 'Utilisateur' }}</div>
            </div>
        </div>
        @endauth

        <!-- Navigation -->
        <nav class="p-4 space-y-1.5 flex-1 overflow-y-auto scrollbar-thin">
            @php
                $user = auth()->user();
                $dashRoute = 'dashboard';
                if ($user?->hasRole(\App\Models\User::ROLE_ADMIN)) { $dashRoute = 'admin.dashboard'; }
                elseif ($user?->hasRole(\App\Models\User::ROLE_MANAGER)) { $dashRoute = 'manager.dashboard'; }
                elseif ($user?->hasRole(\App\Models\User::ROLE_DELEGATE)) { $dashRoute = 'delegate.dashboard'; }
                elseif ($user?->hasRole(\App\Models\User::ROLE_PRO_SANTÉ)) { $dashRoute = 'praticien.dashboard'; }
            @endphp

            <!-- Tableau de bord -->
            <a href="{{ Route::has($dashRoute) ? route($dashRoute) : route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('*.dashboard') || request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="truncate">Tableau de bord</span>
            </a>

            <!-- Calendrier -->
            <a href="{{ Route::has('calendrier.index') ? route('calendrier.index') : '#' }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('calendrier.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="truncate">Calendrier</span>
            </a>

            <!-- Visites -->
            @if(Route::has('visites.index'))
            <a href="{{ route('visites.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('visites.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                <span class="truncate">Visites</span>
            </a>
            @endif

            <!-- Praticiens -->
            @if(Route::has('praticiens.index'))
            <a href="{{ route('praticiens.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('praticiens.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="truncate">Praticiens</span>
            </a>
            @endif

            <!-- Rapports -->
            @if(Route::has('rapports.index'))
            <a href="{{ route('rapports.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('rapports.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <span class="truncate">Rapports</span>
            </a>
            @endif

            <!-- Notifications / Messages -->
            @if(Route::has('messages.inbox'))
            <a href="{{ route('messages.inbox') }}" class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('messages.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <div class="flex items-center gap-3 min-w-0">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="truncate">Notifications</span>
                </div>
                <span class="bg-red-500 text-white text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center shadow-sm flex-shrink-0">3</span>
            </a>
            @endif

            <!-- Campagnes -->
            @if(Route::has('campaigns.index'))
            <a href="{{ route('campaigns.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('campaigns.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                <span class="truncate">Campagnes</span>
            </a>
            @endif

            <!-- Productivité / Analytics -->
            @php
                $analyticsRoute = Route::has('admin.analytics') ? 'admin.analytics' : (Route::has('manager.analytics') ? 'manager.analytics' : 'dashboard.productivity');
            @endphp
            @if(Route::has($analyticsRoute))
            <a href="{{ route($analyticsRoute) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('*.analytics') || request()->routeIs('dashboard.productivity') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                <span class="truncate">Analytics</span>
            </a>
            @endif

            <!-- Paramètres -->
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('profile.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.607 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="truncate">Paramètres</span>
            </a>
        </nav>

        <!-- Déconnexion -->
        <div class="p-4 border-t border-slate-100/80 flex-shrink-0">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 w-full text-left rounded-xl text-sm font-bold text-red-600 hover:bg-red-50 transition-colors">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span class="truncate">Déconnexion</span>
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
