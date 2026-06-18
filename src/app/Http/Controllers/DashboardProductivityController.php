<?php

namespace App\Http\Controllers;

use App\Models\Visite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardProductivityController extends Controller
{
    public function index()
    {
        // 1. Nombre total de visites ce mois-ci
        $visitesCeMois = Visite::whereMonth('date_visite', Carbon::now()->month)
            ->whereYear('date_visite', Carbon::now()->year)
            ->count();

        // 2. Taux de complétion des rapports (visites réalisées vs total)
        $totalVisites = Visite::count();
        $visitesRealisees = Visite::where('statut', 'realisee')->count();
        $tauxCompletion = $totalVisites > 0 ? round(($visitesRealisees / $totalVisites) * 100) : 0;

        // 3. Le top praticien le plus visité
        $topPraticien = Visite::select('praticien_id', DB::raw('count(*) as total'))
            ->with('praticien')
            ->groupBy('praticien_id')
            ->orderByDesc('total')
            ->first();

        // 4. Évolution mensuelle de la productivité (Nombre de visites par mois)
        $evolutionVisites = Visite::select(
            DB::raw("to_char(date_visite, 'YYYY-MM') as mois"),
            DB::raw("count(*) as total")
        )
        ->groupBy('mois')
        ->orderBy('mois', 'asc')
        ->get();

        return view('dashboard.productivity', compact(
            'visitesCeMois',
            'tauxCompletion',
            'topPraticien',
            'evolutionVisites',
            'totalVisites'
        ));
    }
}