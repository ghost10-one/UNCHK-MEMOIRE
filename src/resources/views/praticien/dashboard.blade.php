<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Professionnel de Santé') }}
        </h2>
    </x-slot>

    @php
        $reportCount = \App\Models\Visite::where('praticien_id', auth()->id())->whereNotNull('compte_rendu')->count();
        $visitCount = \App\Models\Visite::where('praticien_id', auth()->id())->count();
        $pendingVisitCount = \App\Models\Visite::where('praticien_id', auth()->id())->where('statut', 'planifiee')->count();
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-3 mb-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Visites associées</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $visitCount }}</div>
                    <p class="text-sm text-gray-500 mt-2">Toutes les visites où vous intervenez.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Rapports renseignés</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $reportCount }}</div>
                    <p class="text-sm text-gray-500 mt-2">Rapports de visites validés.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Visites à venir</h3>
                    <div class="text-4xl font-bold text-gray-900">{{ $pendingVisitCount }}</div>
                    <p class="text-sm text-gray-500 mt-2">Visites planifiées dans votre agenda.</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Vos accès</h3>
                <div class="grid gap-4 md:grid-cols-3">
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5">
                        <h4 class="font-semibold text-gray-900">Consulter les visites</h4>
                        <p class="text-sm text-gray-500 mt-2">Accès aux visites où vous êtes praticien.</p>
                    </div>
                    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5">
                        <h4 class="font-semibold text-gray-900">Voir les rapports</h4>
                        <p class="text-sm text-gray-500 mt-2">Consulter les comptes rendus associés.</p>
                    </div>
                    <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5">
                        <h4 class="font-semibold text-gray-900">Pas de gestion campagnes</h4>
                        <p class="text-sm text-gray-500 mt-2">Ce rôle n’inclut pas la gestion des campagnes.</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-3 mt-6">
                <a href="{{ route('visites.index') }}" class="block p-6 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                    <h4 class="font-semibold text-gray-900">Mes visites</h4>
                    <p class="text-sm text-gray-500 mt-2">Voir les détails de vos visites.</p>
                </a>

                <a href="{{ route('profile.edit') }}" class="block p-6 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                    <h4 class="font-semibold text-gray-900">Mon profil</h4>
                    <p class="text-sm text-gray-500 mt-2">Mettre à jour vos informations.</p>
                </a>

                <a href="{{ route('visites.index', ['search' => '']) }}" class="block p-6 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                    <h4 class="font-semibold text-gray-900">Historique</h4>
                    <p class="text-sm text-gray-500 mt-2">Rechercher vos visites et rapports.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
