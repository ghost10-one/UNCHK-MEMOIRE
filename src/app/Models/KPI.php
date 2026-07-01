<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class KPI extends Model
{
// Les vues SQL n'ont pas de timestamps
public $timestamps = false;
protected $connection = 'pgsql';

/**
* Récupère les visites par délégué (avec cache 5min)
*/
public static function visitesParDeligue()
{
return Cache::remember('kpi.visites_par_delegue', 300, function () {
return DB::table('visites_par_delegue')->get();
});
}

/**
* Récupère les campagnes actives par zone (avec cache 5min)
*/
public static function campaignesActivesParZone()
{
return Cache::remember('kpi.campagnes_actives_par_zone', 300, function () {
return DB::table('campagnes_actives_par_zone')->get();
});
}

/**
* Récupère le taux de réalisation des tournées (avec cache 5min)
*/
public static function tauxRealisationTournees()
{
return Cache::remember('kpi.taux_realisation_tournees', 300, function () {
return DB::table('taux_realisation_tournees')->get();
});
}

/**
* Récupère la performance mensuelle (avec cache 5min)
*/
public static function performanceMensuelle()
{
return Cache::remember('kpi.performance_mensuelle', 300, function () {
return DB::table('performance_mensuelle')->orderBy('mois', 'desc')->get();
});
}

/**
* Récupère la distribution des statuts de visites (avec cache 5min)
*/
public static function distributionStatutsVisites()
{
return Cache::remember('kpi.distribution_statuts_visites', 300, function () {
return DB::table('distribution_statuts_visites')->get();
});
}

/**
* Récupère les statistiques globales
*/
public static function statistiquesGlobales()
{
return Cache::remember('kpi.stats_globales', 300, function () {
$totalVisites = DB::table('visites')->count();
$visitesCompletees = DB::table('visites')->where('statut', 'completed')->count();
$tauxGlobal = $totalVisites > 0 ? round(($visitesCompletees / $totalVisites) * 100, 2) : 0;

return [
'total_visites' => $totalVisites,
'visites_completees' => $visitesCompletees,
'visites_en_attente' => DB::table('visites')->where('statut', 'pending')->count(),
'delegues_actifs' => DB::table('users')->where('role', 'delegue')->count(),
'campagnes_actives' => DB::table('campaigns')->where('statut', 'active')->count(),
'taux_completion_global' => $tauxGlobal,
];
});
}

/**
* Récupère les visites par mois (pour Chart.js)
*/
public static function visitesParMois($mois = 12)
{
return DB::table('visites')
->selectRaw('DATE_TRUNC(\'month\', created_at)::DATE as mois, COUNT(*) as total')
->where('created_at', '>=', now()->subMonths($mois))
->groupByRaw('DATE_TRUNC(\'month\', created_at)')
->orderBy('mois', 'asc')
->get();
}

/**
* Récupère les top délégués par nombre de visites
*/
public static function topDelegues($limit = 5)
{
return Cache::remember('kpi.top_delegues', 300, function () use ($limit) {
return DB::table('visites_par_delegue')
->orderBy('total_visites', 'desc')
->limit($limit)
->get();
});
}

/**
* Récupère les KPI filtrés par période et zone
*/
public static function kpiFiltres($dateDebut = null, $dateFin = null, $zone = null, $delegueId = null)
{
$query = DB::table('visites');

if ($dateDebut) {
$query->where('created_at', '>=', $dateDebut);
}

if ($dateFin) {
$query->where('created_at', '<=', $dateFin . ' 23:59:59');
}

if ($zone) {
$query->whereIn('campaign_id', function ($subquery) use ($zone) {
$subquery->select('id')->from('campaigns')->where('zone', $zone);
});
}

if ($delegueId) {
$query->where('delegue_id', $delegueId);
}

$totalVisites = (clone $query)->count();
$visitesCompletees = (clone $query)->where('statut', 'completed')->count();
$taux = $totalVisites > 0 ? round(($visitesCompletees / $totalVisites) * 100, 2) : 0;

return [
'total_visites' => $totalVisites,
'visites_completees' => $visitesCompletees,
'visites_en_attente' => (clone $query)->where('statut', 'pending')->count(),
'taux_completion' => $taux,
];
}

/**
* Invalide le cache des KPI
*/
public static function invalidateCache()
{
Cache::forget('kpi.visites_par_delegue');
Cache::forget('kpi.campagnes_actives_par_zone');
Cache::forget('kpi.taux_realisation_tournees');
Cache::forget('kpi.performance_mensuelle');
Cache::forget('kpi.distribution_statuts_visites');
Cache::forget('kpi.stats_globales');
Cache::forget('kpi.top_delegues');
}
}