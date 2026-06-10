<?php

use function Livewire\Volt\{state};
use App\Models\Sample;

// Déclaration des variables reliées à la base de données
state([
'totalDistribue' => fn () => Sample::sum('quantite_distribuee') ?? 0,
'totalRestant' => fn () => (Sample::sum('quantite_initiale') - Sample::sum('quantite_distribuee')) ?? 0
]);

?>

<div wire:poll.30s class="p-6 bg-white rounded-xl shadow-md border border-gray-100">

<div class="flex items-center justify-between mb-4">
<h3 class="text-lg font-bold text-gray-800">📊 Suivi des Échantillons Médicaux</h3>
<div class="flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold text-orange-600 bg-orange-50 rounded-full">
<span class="relative flex h-2 w-2">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
<span class="relative inline-flex rounded-full h-2 w-2 bg-orange-500"></span>
</span>
<span>En temps réel (30s)</span>
</div>
</div>

<!-- Statistiques Globales -->
<div class="grid grid-cols-2 gap-4 mb-4">
<div class="p-4 bg-gray-50 rounded-lg">
<span class="text-xs font-medium text-gray-500 uppercase tracking-wider block">Distribués</span>
<span class="text-2xl font-bold text-orange-500">{{ $totalDistribue }}</span>
</div>
<div class="p-4 bg-gray-50 rounded-lg">
<span class="text-xs font-medium text-gray-500 uppercase tracking-wider block">Stock Restant</span>
<span class="text-2xl font-bold text-green-600">{{ $totalRestant }}</span>
</div>
</div>

<!-- Barre de Progression Horizontale -->
<div class="w-full bg-gray-200 rounded-full h-2.5">
<div class="bg-orange-500 h-2.5 rounded-full" style="width: 28%"></div>
</div>

</div>
