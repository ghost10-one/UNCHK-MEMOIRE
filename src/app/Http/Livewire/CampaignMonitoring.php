<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KPI;

use App\Models\Sample;

class CampaignMonitoring extends Component
{
public $dateDebut = null;
public $dateFin = null;
public $zone = null;
public $produit = null;
public $zones = [];
public $produits = [];

public $statsGlobales = [];
public $visitesParMois = [];
public $distributionStatuts = [];
public $topDelegues = [];

public $totalDistribue = 0;
public $totalRemaining = 0;
public $progress = 0;
public $alertStyle = '';
public $alertMessage = '';

public function mount()
{
$this->loadData();
}

public function updated()
{
// Invalide le cache et recharge les données quand un filtre change
KPI::invalidateCache();
$this->loadData();
}

public function loadData()
{
// Récupère les statistiques globales
$this->statsGlobales = KPI::statistiquesGlobales();

// Récupère les visites par mois (pour le graphique en courbe)
$visitesParMois = KPI::visitesParMois(12);
$this->visitesParMois = [
'labels' => $visitesParMois->pluck('mois')->map(fn($m) => \Carbon\Carbon::parse($m)->format('M Y'))->toArray(),
'data' => $visitesParMois->pluck('total')->toArray(),
];

// Récupère la distribution des statuts (pour le camembert)
$distribution = KPI::distributionStatutsVisites();
$this->distributionStatuts = [
'labels' => $distribution->pluck('statut')->toArray(),
'data' => $distribution->pluck('nombre')->toArray(),
'colors' => ['#10b981', '#f59e0b', '#ef4444', '#6b7280'],
];

// Récupère les top délégués
$this->topDelegues = KPI::topDelegues(5)->toArray();

// Récupère les informations des échantillons (stock)
$totalInitial = Sample::sum('initial_quantity') ?? 0;
$this->totalRemaining = Sample::sum('remaining_quantity') ?? 0;
$this->totalDistribue = max(0, $totalInitial - $this->totalRemaining);

if ($totalInitial === 0) {
    $this->progress = 0;
} else {
    $this->progress = min(100, (int) round(($this->totalDistribue / $totalInitial) * 100));
}

if ($this->totalRemaining === 0) {
    $this->alertStyle = 'bg-red-50 text-red-700';
    $this->alertMessage = 'Stock épuisé';
} elseif ($this->totalRemaining < 50) {
    $this->alertStyle = 'bg-amber-50 text-amber-700';
    $this->alertMessage = 'Stock critique';
} elseif ($this->totalRemaining < 150) {
    $this->alertStyle = 'bg-blue-50 text-blue-700';
    $this->alertMessage = 'Stock faible';
} else {
    $this->alertStyle = 'bg-blue-50 text-blue-700';
    $this->alertMessage = 'Stock stable';
}
}

public function resetFilters()
{
$this->dateDebut = null;
$this->dateFin = null;
$this->zone = null;
$this->produit = null;
KPI::invalidateCache();
$this->loadData();
}

public function render()
{
return view('livewire.campaign-monitoring');
}
}