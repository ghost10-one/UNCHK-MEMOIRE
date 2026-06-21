<?php

namespace App\Exports;

use App\Models\Visite;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VisitesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // Récupère les données
    public function collection()
    {
        // On récupère les visites avec le nom du praticien lié
        return Visite::with('praticien')->get()->map(function ($visite) {
            return [
                $visite->id,
                $visite->date_visite,
                $visite->praticien->nom ?? 'Non assigné', // Accès sécurisé
                $visite->motif,
                $visite->statut,
            ];
        });
    }

    // Définit les titres des colonnes dans le fichier Excel
    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Praticien',
            'Motif',
            'Statut'
        ];
    }
}

    