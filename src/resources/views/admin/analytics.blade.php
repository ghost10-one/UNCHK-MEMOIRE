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

            <div class="bg-white p-4 rounded shadow mt-6">
                <form method="get" class="flex gap-2 items-end">
                    <div>
                        <label class="block text-sm">Zone</label>
                        <select name="zone_id" class="mt-1 block border rounded px-2 py-1">
                            <option value="">Toutes</option>
                            @foreach($zones as $z)
                                <option value="{{ $z->id }}" @if($zone == $z->id) selected @endif>{{ $z->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Filtrer</button>
                    </div>
                    <div>
                        <a href="{{ route('analytics') }}" class="px-4 py-2 bg-gray-200 rounded">Réinitialiser</a>
                    </div>
                </form>
            </div>

            <div class="bg-white p-4 rounded shadow mt-6">
                <h3 class="text-lg font-semibold mb-4">Corrélation campagnes ↔ visites</h3>
                @if(empty($rows) || $rows->isEmpty())
                    <p>Aucune campagne trouvée pour les filtres sélectionnés.</p>
                @else
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Campagne</th>
                                <th class="px-4 py-2">Période</th>
                                <th class="px-4 py-2">Visites pendant</th>
                                <th class="px-4 py-2">Visites avant</th>
                                <th class="px-4 py-2">Δ</th>
                                <th class="px-4 py-2">% changement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $r)
                                <tr>
                                    <td class="border px-4 py-2">{{ $r->titre }}</td>
                                    <td class="border px-4 py-2">{{ $r->date_debut }} → {{ $r->date_fin }}</td>
                                    <td class="border px-4 py-2 text-right">{{ $r->visites_during }}</td>
                                    <td class="border px-4 py-2 text-right">{{ $r->visites_before }}</td>
                                    <td class="border px-4 py-2 text-right">{{ $r->delta }}</td>
                                    <td class="border px-4 py-2 text-right">{{ $r->percent_change === null ? 'N/A' : $r->percent_change . '%' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
