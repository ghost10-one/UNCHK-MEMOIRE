 <div class="bg-white rounded-lg shadow-lg p-6">
<div class="mb-6">
<h2 class="text-2xl font-bold text-gray-800 mb-4">📊 Monitoring Campagne</h2>

<!-- Filtres -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Date Début</label>
<input type="date" wire:model.live="dateDebut" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Date Fin</label>
<input type="date" wire:model.live="dateFin" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Zone</label>
<input type="text" wire:model.live="zone" placeholder="Ex: Zone A" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>
<div>
<label class="block text-sm font-medium text-gray-700 mb-1">Produit</label>
<input type="text" wire:model.live="produit" placeholder="Ex: Produit A" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>
<div class="flex items-end">
<button wire:click="resetFilters" class="w-full px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
Réinitialiser
</button>
</div>
</div>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
<div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-4 text-white">
<p class="text-sm opacity-90">Visites Totales</p>
<p class="text-3xl font-bold">{{ $statsGlobales['total_visites'] ?? 0 }}</p>
</div>
<div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-4 text-white">
<p class="text-sm opacity-90">Visites Complétées</p>
<p class="text-3xl font-bold">{{ $statsGlobales['visites_completees'] ?? 0 }}</p>
</div>
<div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-4 text-white">
<p class="text-sm opacity-90">En Attente</p>
<p class="text-3xl font-bold">{{ $statsGlobales['visites_en_attente'] ?? 0 }}</p>
</div>
<div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-4 text-white">
<p class="text-sm opacity-90">Taux Complétion</p>
<p class="text-3xl font-bold">{{ $statsGlobales['taux_completion_global'] ?? 0 }}%</p>
</div>
</div>

<!-- Charts -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
<!-- Graphique Ligne : Visites par Mois -->
<div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
<h3 class="text-lg font-semibold text-gray-800 mb-4">📈 Visites par Mois</h3>
<canvas id="visitesParMoisChart"></canvas>
    <!-- Statistiques Globales -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
        <div class="p-4 bg-slate-50 rounded-2xl">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block">Distribués</span>
            <span class="text-2xl font-bold text-blue-600">{{ $this->totalDistribue }}</span>
        </div>
        <div class="p-4 bg-slate-50 rounded-2xl">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block">Stock Restant</span>
            <span class="text-2xl font-bold text-slate-700">{{ $this->totalRemaining }}</span>
        </div>
    </div>

    <div class="p-4 rounded-2xl mb-4 {{ $this->alertStyle }} border border-current/10">
        <span class="text-sm font-semibold">{{ $this->alertMessage }}</span>
    </div>

    <!-- Barre de Progression Horizontale -->
    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $this->progress }}%"></div>
    </div>
</div>

<!-- Graphique Camembert : Distribution Statuts -->
<div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
<h3 class="text-lg font-semibold text-gray-800 mb-4">🥧 Distribution des Statuts</h3>
<canvas id="distributionStatutsChart"></canvas>
</div>
</div>

<!-- Top Délégués -->
<div class="bg-gray-50 rounded-lg p-4 border border-gray-200 mb-8">
<h3 class="text-lg font-semibold text-gray-800 mb-4">🏆 Top 5 Délégués</h3>
<div class="overflow-x-auto">
<table class="w-full text-sm">
<thead>
<tr class="border-b border-gray-300">
<th class="text-left py-2 px-3">Délégué</th>
<th class="text-right py-2 px-3">Visites</th>
<th class="text-right py-2 px-3">Complétées</th>
<th class="text-right py-2 px-3">Taux</th>
</tr>
</thead>
<tbody>
@foreach($topDelegues as $delegue)
<tr class="border-b border-gray-200 hover:bg-gray-100">
<td class="py-2 px-3">{{ $delegue['name'] ?? 'N/A' }}</td>
<td class="text-right py-2 px-3">{{ $delegue['total_visites'] ?? 0 }}</td>
<td class="text-right py-2 px-3">{{ $delegue['visites_completees'] ?? 0 }}</td>
<td class="text-right py-2 px-3">
<span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs font-semibold">
{{ $delegue['taux_realisation'] ?? 0 }}%
</span>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>

<!-- Classement des Délégués -->
<div class="bg-gray-50 rounded-lg p-4 border border-gray-200 mt-8">
<h3 class="text-lg font-semibold text-gray-800 mb-4">🏅 Classement Complet des Délégués</h3>
<div class="overflow-x-auto">
<table class="w-full text-sm">
<thead>
<tr class="border-b border-gray-300 bg-gray-100">
<th class="text-left py-3 px-4 font-semibold">Délégué</th>
<th class="text-right py-3 px-4 font-semibold">Visites Totales</th>
<th class="text-right py-3 px-4 font-semibold">Complétées</th>
<th class="text-right py-3 px-4 font-semibold">Taux Réalisation</th>
</tr>
</thead>
<tbody>
@forelse($topDelegues as $delegue)
<tr class="border-b border-gray-200 hover:bg-white transition">
<td class="py-3 px-4 font-medium">{{ $delegue['name'] ?? 'N/A' }}</td>
<td class="text-right py-3 px-4">
<span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
{{ $delegue['total_visites'] ?? 0 }}
</span>
</td>
<td class="text-right py-3 px-4">
<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">
{{ $delegue['visites_completees'] ?? 0 }}
</span>
</td>
<td class="text-right py-3 px-4">
<span class="bg-gradient-to-r from-green-400 to-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
{{ $delegue['taux_realisation'] ?? 0 }}%
</span>
</td>
</tr>
@empty
<tr>
<td colspan="4" class="text-center py-4 text-gray-500">Aucun délégué trouvé</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js">