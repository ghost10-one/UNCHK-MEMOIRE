<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager Analytics') }}
        </h2>
    </x-slot>
    <!-- m   cndmmdmd dkdkdkdknddfmff -->

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
                <p class="text-sm text-gray-500">Suivez la performance des campagnes et préparez les actions sur terrain.</p>
                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-sm text-gray-600">Utilisez ces données pour prioriser les visites.</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-sm text-gray-600">Tirez des enseignements des rapports réalisés.</p>
                    </div>
                </div>
            </div>
       <!-- Filtre Zone -->
<div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm mt-6">
<form method="GET" class="flex items-center gap-4">
<label class="font-medium">Zone :</label>

<select name="zone_id" class="border rounded-lg px-3 py-2">
<option value="">Toutes les zones</option>

@foreach($zones as $z)
<option value="{{ $z->id }}"
{{ $zone == $z->id ? 'selected' : '' }}>
{{ $z->name }}
</option>
@endforeach
</select>

<button
type="submit"
class="bg-blue-600 text-white px-4 py-2 rounded-lg">
Filtrer
</button>
</form>
</div>

<!-- Analyse campagnes -->
<div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm mt-6">
<h3 class="text-lg font-semibold mb-4">
Impact des campagnes
</h3>

<div class="overflow-x-auto">
<table class="min-w-full border">
<thead class="bg-gray-100">
<tr>
<th class="p-3 text-left">Campagne</th>
<th class="p-3 text-left">Visites avant</th>
<th class="p-3 text-left">Visites pendant</th>
<th class="p-3 text-left">Delta</th>
<th class="p-3 text-left">Variation</th>
</tr>
</thead>

<tbody>
@foreach($rows as $row)
<tr class="border-t">
<td class="p-3">{{ $row->titre }}</td>

<td class="p-3">
{{ $row->visites_before }}
</td>

<td class="p-3">
{{ $row->visites_during }}
</td>

<td class="p-3">
{{ $row->delta }}
</td>

<td class="p-3">
@if($row->percent_change !== null)
{{ $row->percent_change }} %
@else
-
@endif
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>

<!-- Top délégués -->
<div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm mt-6">
<h3 class="text-lg font-semibold mb-4">
Classement des délégués
</h3>

<div class="overflow-x-auto">
<table class="min-w-full border">
<thead class="bg-gray-100">
<tr>
<th class="p-3 text-left">Nom</th>
<th class="p-3 text-left">Visites</th>
</tr>
</thead>

<tbody>
@foreach($delegues as $delegue)
<tr class="border-t">
<td class="p-3">
{{ $delegue->name }}
</td>

<td class="p-3 font-semibold">
{{ $delegue->visites_count }}
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div> </div>
    </div>
</x-app-layout>
