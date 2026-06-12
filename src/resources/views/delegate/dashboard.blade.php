<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Délégué Médical') }}
        </h2>
    </x-slot>

    @php
        $upcomingVisits = \App\Models\Visite::where('delegue_id', auth()->id())
            ->whereDate('date_visite', '>=', now()->format('Y-m-d'))
            ->count();
        $pendingReports = \App\Models\Visite::where('delegue_id', auth()->id())
            ->where('statut', 'realisee')
            ->whereNull('compte_rendu')
            ->count();
        $totalVisits = \App\Models\Visite::where('delegue_id', auth()->id())->count();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-3 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Visites programmées</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $upcomingVisits }}</div>
                    <p class="text-sm text-gray-500 mt-2">Préparez vos visites terrain.</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Rapports en attente</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $pendingReports }}</div>
                    <p class="text-sm text-gray-500 mt-2">Visites réalisées sans compte rendu.</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Visites totales</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $totalVisits }}</div>
                    <p class="text-sm text-gray-500 mt-2">Historique de vos actions terrain.</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Vos accès</h3>
                <div class="grid gap-4 md:grid-cols-3">
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                        <h4 class="font-semibold text-gray-900">Planifier et éditer</h4>
                        <p class="text-sm text-gray-500 mt-2">Vous pouvez planifier et modifier vos visites.</p>
                    </div>
                    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5">
                        <h4 class="font-semibold text-gray-900">Rédiger des rapports</h4>
                        <p class="text-sm text-gray-500 mt-2">Compléter vos comptes rendus de visite.</p>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5">
                        <h4 class="font-semibold text-gray-900">Consulter les rapports</h4>
                        <p class="text-sm text-gray-500 mt-2">Accéder à vos rapports et à l’historique.</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-3 mt-6">
                <a href="{{ route('visites.index') }}" class="block p-6 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                    <h4 class="font-semibold text-gray-900">Mes visites</h4>
                    <p class="text-sm text-gray-500 mt-2">Voir et gérer vos visites.</p>
                </a>

                <a href="{{ route('visites.index', ['statut' => 'realisee']) }}" class="block p-6 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                    <h4 class="font-semibold text-gray-900">Mes rapports</h4>
                    <p class="text-sm text-gray-500 mt-2">Accéder aux rapports à compléter.</p>
                </a>

                <a href="{{ route('profile.edit') }}" class="block p-6 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                    <h4 class="font-semibold text-gray-900">Mon profil</h4>
                    <p class="text-sm text-gray-500 mt-2">Mettre à jour vos informations.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
