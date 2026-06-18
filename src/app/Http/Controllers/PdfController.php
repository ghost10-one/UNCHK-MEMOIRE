<?php

namespace App\Http\Controllers;

use App\Actions\GenerateRapportPdfAction;
use App\Models\Visite;

class PdfController extends Controller
{
    public function __invoke(GenerateRapportPdfAction $generatePdf)
    {
        // Extraction des données réelles de la base de données (PostgreSQL)
        $visitesDuJour = Visite::duJour()->count();
        $visitesSemaine = Visite::deLaSemaine()->count();
        $rapportsEnAttente = Visite::rapportsEnAttente()->count();
        
        $totalVisitesObj = 20; 
        $realiseCount = Visite::realisees()->whereMonth('date_visite', now()->month)->count();
        $tauxRealisation = $totalVisitesObj > 0 ? round(($realiseCount / $totalVisitesObj) * 100) : 0;
        
        $prochainesVisites = Visite::with(['praticien'])
            ->aVenir()
            ->take(3)
            ->get();

        $payload = [
            'visitesDuJour'     => $visitesDuJour,
            'visitesSemaine'    => $visitesSemaine,
            'rapportsEnAttente' => $rapportsEnAttente,
            'totalVisitesObj'   => $totalVisitesObj,
            'realiseCount'      => $realiseCount,
            'tauxRealisation'   => $tauxRealisation,
            'prochainesVisites' => $prochainesVisites,
        ];

        return $generatePdf->execute($payload);
    }
}