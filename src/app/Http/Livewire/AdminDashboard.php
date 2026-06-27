<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminDashboard extends Component
{
    public $start_date;
    public $end_date;
    public $zone_id;
    public $produit;
    public $zones = [];

    protected $queryString = [
        'start_date' => ['except' => ''],
        'end_date' => ['except' => ''],
        'zone_id' => ['except' => ''],
        'produit' => ['except' => ''],
    ];

    public function mount()
    {
        $this->start_date = request()->query('start_date') ?: Carbon::now()->subMonths(6)->startOfMonth()->format('Y-m-d');
        $this->end_date = request()->query('end_date') ?: Carbon::now()->format('Y-m-d');
        $this->zone_id = request()->query('zone_id');
        $this->produit = request()->query('produit');
         $this->zones = DB::table('zones')
->select('id', 'name')
->orderBy('name')
->get();


    }

    public function updated($property)
    {
        if (in_array($property, ['start_date', 'end_date', 'zone_id', 'produit'])) {
            $this->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'zone_id' => 'nullable|integer',
                'produit' => 'nullable|string|max:255',
            ]);
        }
    }

    public function resetFilters()
    {
        $this->start_date = Carbon::now()->subMonths(6)->startOfMonth()->format('Y-m-d');
        $this->end_date = Carbon::now()->format('Y-m-d');
        $this->zone_id = null;
        $this->produit = null;
    }

    protected function filters(): array
    {
        return [
            'start' => Carbon::parse($this->start_date)->startOfDay(),
            'end' => Carbon::parse($this->end_date)->endOfDay(),
            'zone' => $this->zone_id,
            'produit' => $this->produit,
        ];
    }

    protected function applyFilters($query)
    {
        $filters = $this->filters();

        $query->whereBetween('date_visite', [$filters['start'], $filters['end']]);

        if ($filters['zone']) {
            $query->where('zone_id', $filters['zone']);
        }

        if ($filters['produit']) {
            $query->where('produit_presente', 'ilike', "%{$filters['produit']}%");
        }

        return $query;
    }

    public function getStatsProperty(): array
    {
        $filters = $this->filters();
        $cacheKey = sprintf('admin_dashboard_stats_%s_%s_z%s_p%s', $filters['start']->toDateString(), $filters['end']->toDateString(), $filters['zone'] ?: 'all', $filters['produit'] ?: 'all');

        return Cache::remember($cacheKey, 300, function () use ($filters) {
            $query = DB::table('visites');
            $query = $this->applyFilters($query);

            $total = $query->count();
            $completees = $query->clone()->where('statut', 'realisee')->count();
            $en_attente = $query->clone()->whereIn('statut', ['planifiee', 'confirmee', 'en_cours'])->count();
            $taux = $total === 0 ? 0 : round(($completees / $total) * 100, 2);

            return [
                'total_visites' => $total,
                'visites_completees' => $completees,
                'visites_en_attente' => $en_attente,
                'taux_completion' => $taux,
            ];
        });
    }

     public function getChartLabelsProperty(): array
{
    $driver = DB::connection()->getDriverName();
    $dateFormat = $driver === 'sqlite'
        ? "strftime('%Y-%m', date_visite)"
        : "to_char(date_visite, 'YYYY-MM')";

    $rows = $this->applyFilters(
        DB::table('visites')
            ->selectRaw("{$dateFormat} as mois, COUNT(id) as total_visites")
            ->groupBy('mois')
            ->orderBy('mois')
    )->get();

    return $rows->pluck('mois')->toArray();
}
    public function getChartDataProperty(): array
    {
        $filters = $this->filters();
        $cacheKey = sprintf('admin_dashboard_data_%s_%s_z%s_p%s', $filters['start']->toDateString(), $filters['end']->toDateString(), $filters['zone'] ?: 'all', $filters['produit'] ?: 'all');

        return Cache::remember($cacheKey, 300, function () use ($filters) {
            $driver = DB::connection()->getDriverName();
            $dateFormat = $driver === 'sqlite'
                ? "strftime('%Y-%m', date_visite)"
                : "to_char(date_visite, 'YYYY-MM')";

  $rows = $this->applyFilters(
DB::table('visites')
->selectRaw("{$dateFormat} as mois, COUNT(id) as total_visites")
->groupBy('mois')
->orderBy('mois')
)->get();
  
            return $rows->map(fn($row) => (int) $row->total_visites)->toArray();
        });
    }

    public function getStatusLabelsProperty(): array
    {
        return collect($this->getStatusDistribution())->pluck('statut')->toArray();
    }

    public function getStatusDataProperty(): array
    {
        return collect($this->getStatusDistribution())->pluck('nombre')->map(fn($amount) => (int) $amount)->toArray();
    }

    protected function getStatusDistribution()
    {
        $filters = $this->filters();
        $cacheKey = sprintf('admin_dashboard_status_%s_%s_z%s_p%s', $filters['start']->toDateString(), $filters['end']->toDateString(), $filters['zone'] ?: 'all', $filters['produit'] ?: 'all');

        return Cache::remember($cacheKey, 300, function () use ($filters) {
            $query = $this->applyFilters(DB::table('visites')->select('statut', DB::raw('COUNT(id) as nombre')));
            return $query->groupBy('statut')->orderByDesc('nombre')->get()->map(fn($item) => (array) $item)->toArray();
        });
    }

    public function getTrendLabelsProperty(): array
    {
        return $this->chartLabels;
    }

     public function getTrendDataProperty(): array
{
    return [];
}

    public function getTopDeleguesProperty()
    {
        $filters = $this->filters();
        $cacheKey = sprintf('admin_dashboard_top_delegues_%s_%s_z%s_p%s', $filters['start']->toDateString(), $filters['end']->toDateString(), $filters['zone'] ?: 'all', $filters['produit'] ?: 'all');

        return Cache::remember($cacheKey, 300, function () use ($filters) {
            $query = DB::table('visites')
                ->join('users', 'users.id', '=', 'visites.delegue_id')
                ->select('users.name', DB::raw('COUNT(visites.id) as total_visites'));

            $query = $this->applyFilters($query);

            return $query->groupBy('users.id', 'users.name')
                ->orderByDesc('total_visites')
                ->limit(5)
                ->get()
                ->map(fn($item) => (array) $item)
                ->toArray();
        });
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
