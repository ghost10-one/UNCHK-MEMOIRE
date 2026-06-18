<?php

namespace App\Observers;

use App\Models\Visite;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class VisiteObserver
{
    /**
     * Handle the Visite "created" event.
     */
    public function created(Visite $visite): void
    {
        if (Auth::check()) {
            AuditLog::create([
                'user_id'     => Auth::id(),
                'action'      => 'CREATE_VISITE',
                'description' => "Planification d'une visite avec le praticien n°{$visite->praticien_id} pour le " . $visite->date_visite->format('d/m/Y'),
                'ip_address'  => Request::ip(),
                'user_agent'  => Request::userAgent(),
                'metadata'    => [
                    'model_type' => Visite::class,
                    'model_id'   => $visite->id,
                    'new_values' => $visite->only(['delegue_id', 'praticien_id', 'date_visite', 'statut']),
                ],
            ]);
        }
    }

    /**
     * Handle the Visite "updated" event.
     */
    public function updated(Visite $visite): void
    {
        if (Auth::check()) {
            $changements = $visite->getChanges();
            unset($changements['updated_at']);
            
            if (empty($changements)) return;

            $anciennesValeurs = array_intersect_key($visite->getOriginal(), $changements);

            AuditLog::create([
                'user_id'     => Auth::id(),
                'action'      => 'UPDATE_VISITE',
                'description' => "Mise à jour de la visite n°{$visite->id} (Nouveau statut : {$visite->statut_label})",
                'ip_address'  => Request::ip(),
                'user_agent'  => Request::userAgent(),
                'metadata'    => [
                    'model_type' => Visite::class,
                    'model_id'   => $visite->id,
                    'old_values' => $anciennesValeurs,
                    'new_values' => $changements,
                ],
            ]);
        }
    }

    /**
     * Handle the Visite "deleted" event.
     */
    public function deleted(Visite $visite): void
    {
        if (Auth::check()) {
            AuditLog::create([
                'user_id'     => Auth::id(),
                'action'      => 'DELETE_VISITE',
                'description' => "Suppression de la visite n°{$visite->id} associée au praticien n°{$visite->praticien_id}",
                'ip_address'  => Request::ip(),
                'user_agent'  => Request::userAgent(),
                'metadata'    => [
                    'model_type' => Visite::class,
                    'model_id'   => $visite->id,
                    'old_values' => $visite->toArray(),
                ],
            ]);
        }
    }
   
}

