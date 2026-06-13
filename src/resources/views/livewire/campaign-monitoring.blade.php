<div wire:poll.visible.30s class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h3 class="text-lg font-bold text-gray-900">📊 Suivi des Échantillons Médicaux</h3>
            <p class="text-sm text-gray-500">Mise à jour toutes les 30 secondes</p>
        </div>
        <div class="flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold text-blue-700 bg-blue-50 rounded-full">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
            </span>
            <span>Temps réel</span>
        </div>
    </div>

    <!-- Statistiques Globales -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
        <div class="p-4 bg-slate-50 rounded-2xl">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block">Distribués</span>
            <span class="text-2xl font-bold text-blue-600">{{ $totalDistribue }}</span>
        </div>
        <div class="p-4 bg-slate-50 rounded-2xl">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider block">Stock Restant</span>
            <span class="text-2xl font-bold text-slate-700">{{ $totalRemaining }}</span>
        </div>
    </div>

    <div class="p-4 rounded-2xl mb-4 {{ $alertStyle }} border border-current/10">
        <span class="text-sm font-semibold">{{ $alertMessage }}</span>
    </div>

    <!-- Barre de Progression Horizontale -->
    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
    </div>
</div>
