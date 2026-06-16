<?php
    namespace App\Actions;

    use Barryvdh\DomPDF\Facade\Pdf;

    class GenerateRapportPdfAction
    {
        /**
         * Reçoit les métriques du tableau de bord, génère le PDF et lance le téléchargement.
         */
        public function execute(array $data)
        {
            // On passe directement le tableau de données à la vue Blade
            $pdf = Pdf::loadView('pdf.rapport-activite', $data);
            
            // Configuration du format A4 en mode Portrait
            $pdf->setPaper('a4', 'portrait');

            // Retourne le flux de téléchargement du fichier
            return $pdf->stream('rapport-santeplus-' . now()->format('Y-m-d') . '.pdf');
        }
    }