<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    @php
        $campaignCount = \App\Models\Campaign::count();
        $activeCampaignCount = \App\Models\Campaign::where('statut', 'en_cours')->count();
        $pendingCampaignCount = \App\Models\Campaign::where('statut', 'planifiee')->count();
        $delegateCount = \App\Models\User::role('delegate')->count();
        $proSanteCount = \App\Models\User::role('pro_santé')->count();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-4 mb-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Campagnes totales</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $campaignCount }}</div>
                    <p class="text-sm text-gray-500 mt-2">Campagnes actives, planifiées ou terminées</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Campagnes en cours</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $activeCampaignCount }}</div>
                    <p class="text-sm text-gray-500 mt-2">Campagnes en cours de déploiement</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Campagnes planifiées</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $pendingCampaignCount }}</div>
                    <p class="text-sm text-gray-500 mt-2">À démarrer prochainement</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Utilisateurs terrain</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $delegateCount + $proSanteCount }}</div>
                    <p class="text-sm text-gray-500 mt-2">Délégués et professionnels de santé actifs</p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3 mb-6">
                <a href="{{ route('campaigns.index') }}" class="block bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition">
                    <h3 class="text-lg font-semibold text-gray-900">Gérer les campagnes</h3>
                    <p class="mt-2 text-sm text-gray-500">Créer, modifier et suivre toutes les campagnes.</p>
                    <span class="mt-4 inline-flex items-center text-sm font-semibold text-blue-600">Voir les campagnes →</span>
                </a>

                <a href="{{ route('admin.analytics') }}" class="block bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition">
                    <h3 class="text-lg font-semibold text-gray-900">Voir les analytics</h3>
                    <p class="mt-2 text-sm text-gray-500">Consulter les performances et les KPIs.</p>
                    <span class="mt-4 inline-flex items-center text-sm font-semibold text-blue-600">Explorer les analytics →</span>
                </a>

                <div class="block bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Administration</h3>
                    <p class="mt-2 text-sm text-gray-500">Gestion des utilisateurs, rôles et autorisations.</p>
                    <p class="mt-4 text-sm text-gray-600">Toutes les permissions d’admin sont activées pour ce compte.</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Monitoring campagne</h3>
                <x-campaign-monitoring />
            </div>
        </div>
    </div>
</x-app-layout>
