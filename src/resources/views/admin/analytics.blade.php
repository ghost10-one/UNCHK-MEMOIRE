<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Analytics') }}
        </h2>
    </x-slot>

    @php
        $totalCampaigns = \App\Models\Campaign::count();
        $activeCampaigns = \App\Models\Campaign::where('statut', 'en_cours')->count();
        $completedCampaigns = \App\Models\Campaign::where('statut', 'terminee')->count();
        $recentVisits = \App\Models\Visite::whereBetween('date_visite', [now()->subWeek(), now()])->count();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-4 mb-6">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500">Campagnes totales</h3>
                    <div class="text-3xl font-bold text-gray-900 mt-4">{{ $totalCampaigns }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500">Campagnes actives</h3>
                    <div class="text-3xl font-bold text-gray-900 mt-4">{{ $activeCampaigns }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500">Campagnes terminées</h3>
                    <div class="text-3xl font-bold text-gray-900 mt-4">{{ $completedCampaigns }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500">Visites récentes</h3>
                    <div class="text-3xl font-bold text-gray-900 mt-4">{{ $recentVisits }}</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Vue d'ensemble analytics</h3>
                <p class="text-sm text-gray-500">Ce dashboard montre des indicateurs clés pour les campagnes et les visites.</p>
                <ul class="mt-6 space-y-4 text-sm text-gray-600">
                    <li>Suivi des campagnes actives et planifiées.</li>
                    <li>Analyse des conversions basées sur les visites réalisées.</li>
                    <li>Mesure de la productivité terrain par semaine.</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
