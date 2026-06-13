<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager Analytics') }}
        </h2>
    </x-slot>
    <!-- mfmff -->

    @php
        $campaignsCount = \App\Models\Campaign::count();
        $activeCampaigns = \App\Models\Campaign::where('statut', 'en_cours')->count();
        $reportsCount = \App\Models\Visite::where('statut', 'realisee')->count();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3 mb-6">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500">Campagnes</h3>
                    <div class="text-3xl font-bold text-gray-900 mt-4">{{ $campaignsCount }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500">Campagnes actives</h3>
                    <div class="text-3xl font-bold text-gray-900 mt-4">{{ $activeCampaigns }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-sm font-medium text-gray-500">Rapports réalisés</h3>
                    <div class="text-3xl font-bold text-gray-900 mt-4">{{ $reportsCount }}</div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Synthèse analytique</h3>
                <p class="text-sm text-gray-500">Suivez la performance des campagnes et préparez les actions terrain.</p>
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-sm text-gray-600">Utilisez ces données pour prioriser les visites.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-sm text-gray-600">Tirez des enseignements des rapports réalisés.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
