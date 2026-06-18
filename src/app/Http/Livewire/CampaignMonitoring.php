<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KPI;

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