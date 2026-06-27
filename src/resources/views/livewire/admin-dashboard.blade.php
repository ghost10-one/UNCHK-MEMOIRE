<div class="space-y-6">
    <div class="bg-white p-4 rounded-xl shadow-sm flex flex-wrap items-end gap-4">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Date début</label>
            <input type="date" wire:model="start_date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Date fin</label>
            <input type="date" wire:model="end_date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Zone</label>
            <select wire:model="zone_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Toutes</option>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium text-gray-700 mb-1">Produit (nom)</label>
            <input type="text" wire:model.debounce.500ms="produit" placeholder="Ex: Produit A" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="flex items-center gap-2">
            <button wire:click.prevent="resetFilters" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md text-sm font-medium">Réinitialiser</button>
        </div>
    </div>

     <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
<p class="text-sm font-medium text-gray-500">Visites totales</p>
<p class="text-3xl font-bold text-gray-900 mt-2">
{{ $this->stats['total_visites'] ?? 0 }}
</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
<p class="text-sm font-medium text-gray-500">Visites réalisées</p>
<p class="text-3xl font-bold text-green-600 mt-2">
{{ $this->stats['visites_completees'] ?? 0 }}
</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
<p class="text-sm font-medium text-gray-500">Visites en attente</p>
<p class="text-3xl font-bold text-amber-500 mt-2">
{{ $this->stats['visites_en_attente'] ?? 0 }}
</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
<p class="text-sm font-medium text-gray-500">Taux de réalisation</p>
<p class="text-3xl font-bold text-indigo-600 mt-2">
{{ $this->stats['taux_completion'] ?? 0 }}%
</p>
</div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 lg:col-span-2">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Volume des visites par mois</h3>
            <div class="relative h-64">
                <canvas id="adminVisitsChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribution statuts</h3>
            <div class="relative h-64">
                <canvas id="adminStatusPie"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 lg:col-span-3">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tendance réalisation (%)</h3>
            <div class="relative h-64">
                <canvas id="adminTrendChart"></canvas>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Top 5 Délégués</h3>
        <div class="space-y-4">
            @forelse($this->topDelegues as $index => $delegue)
                <div class="flex items-center justify-between pb-2 border-b border-gray-50 last:border-none">
                    <div class="flex items-center space-x-3">
                        <span class="flex items-center justify-center w-6 h-6 rounded-full bg-indigo-50 text-indigo-600 font-bold text-xs">{{ $loop->iteration }}</span>
                        <span class="text-sm font-medium text-gray-700">{{ data_get($delegue, 'name') }}</span>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">{{ data_get($delegue, 'total_visites') }} visites</span>
                </div>
            @empty
                <p class="text-sm text-gray-500 text-center py-4">Aucune donnée disponible</p>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:init', () => { 
        const visitsCtx = document.getElementById('adminVisitsChart').getContext('2d');
        const statusCtx = document.getElementById('adminStatusPie').getContext('2d');
        const trendCtx = document.getElementById('adminTrendChart').getContext('2d');

        const visitsChart =  new Chart(visitsCtx, {
type: 'line',
data: {
 labels: @json($this->chartLabels),
datasets: [{
label: 'Visites',
 data: @json($this->chartData)
}]
}
});
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: { labels: [], datasets: [{ label: 'Statuts', data: [], backgroundColor: ['#6366f1', '#f59e0b', '#10b981', '#ef4444', '#6b7280'] }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });

        const trendChart = new Chart(trendCtx, {
            type: 'line',
            data: { labels: [], datasets: [{ label: 'Taux de réalisation', data: [], borderColor: '#14b8a6', backgroundColor: 'rgba(20, 184, 166, 0.12)', fill: true, tension: 0.3 }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, max: 100, ticks: { callback: value => value + '%' } } } }
        });

          const refreshCharts = () => {
console.log('refresh lancé');
};

        

        refreshCharts();
        Livewire.hook('message.processed', refreshCharts);
    });
</script>
