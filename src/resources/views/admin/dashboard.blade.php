<x-app-layout>
    @php
        $userCount = \App\Models\User::count();
        $visiteCount = \App\Models\Visite::count();
        $campaignCount = \App\Models\Campaign::count();
        $praticienCount = \App\Models\Praticien::count();
    @endphp

    <div class="min-h-screen bg-[#F8FAFC] py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">Tableau de bord Administrateur</h1>
                    <p class="text-slate-500 text-sm mt-1">Supervision globale de la plateforme Sama-Sante</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('campaigns.create') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md shadow-blue-500/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Nouvelle campagne
                    </a>
                </div>
            </div>

            <!-- KPI Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-500">Utilisateurs actifs</span>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $userCount }}</div>
                        <div class="text-xs font-semibold text-emerald-600">Délégués, Managers & Pros</div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-500">Visites enregistrées</span>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $visiteCount }}</div>
                        <div class="text-xs font-semibold text-emerald-600">Planifiées & réalisées</div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-500">Campagnes promotionnelles</span>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $campaignCount }}</div>
                        <div class="text-xs font-semibold text-amber-600">Total campagnes actives</div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between h-36">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-slate-500">Praticiens référencés</span>
                        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                    </div>
                    <div>
                        <div class="text-3xl font-extrabold text-slate-900 mb-1">{{ $praticienCount }}</div>
                        <div class="text-xs font-semibold text-purple-600">Médecins & Établissements</div>
                    </div>
                </div>
            </div>

            <!-- Campaign Monitoring Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-xl font-extrabold text-slate-900 mb-4 tracking-tight">Suivi & Monitoring des Campagnes</h3>
                <x-campaign-monitoring />
            </div>

            <!-- Livewire Admin Dashboard Analytics -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="text-xl font-extrabold text-slate-900 mb-6 tracking-tight">Analytiques terrain & Visites</h3>
                <livewire:admin-dashboard />
            </div>
        </div>
    </div>
</x-app-layout>

