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
</div>

<!-- Graphique Camembert : Distribution Statuts -->
<div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
<h3 class="text-lg font-semibold text-gray-800 mb-4">🥧 Distribution des Statuts</h3>
<canvas id="distributionStatutsChart"></canvas>
</div>
</div>

<!-- Top Délégués -->
<div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
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
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
// Graphique Ligne : Visites par Mois
const visitesParMoisCtx = document.getElementById('visitesParMoisChart');
if (visitesParMoisCtx) {
new Chart(visitesParMoisCtx, {
type: 'line',
data: {
labels: {!! json_encode($visitesParMois['labels'] ?? []) !!},
datasets: [{
label: 'Visites',
data: {!! json_encode($visitesParMois['data'] ?? []) !!},
borderColor: '#3b82f6',
backgroundColor: 'rgba(59, 130, 246, 0.1)',
borderWidth: 2,
fill: true,
tension: 0.4,
pointRadius: 4,
pointBackgroundColor: '#3b82f6'
}]
},
options: {
responsive: true,
maintainAspectRatio: true,
plugins: {
legend: {
display: true,
position: 'top'
}
},
scales: {
y: {
beginAtZero: true,
ticks: {
stepSize: 1
}
}
}
}
});
}

// Graphique Camembert : Distribution Statuts
const distributionStatutsCtx = document.getElementById('distributionStatutsChart');
if (distributionStatutsCtx) {
new Chart(distributionStatutsCtx, {
type: 'doughnut',
data: {
labels: {!! json_encode($distributionStatuts['labels'] ?? []) !!},
datasets: [{
data: {!! json_encode($distributionStatuts['data'] ?? []) !!},
backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#6b7280']
}]
},
options: {
responsive: true,
maintainAspectRatio: true,
plugins: {
legend: {
display: true,
position: 'bottom'
}
}
}
});
}
});
</script>