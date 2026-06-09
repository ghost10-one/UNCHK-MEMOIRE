<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * ============================================================
 * SPRINT 1 — AB (Abibou Ndione)
 * Modèle Visite + relations + scopes
 * Carte #1 — belongsTo User (délégué) · belongsTo Praticien
 *             scopes: parDelegue(), duMois()
 * Checklist : factory Visite · test relations · scope filtre
 * ============================================================
 *
 * @property int    $id
 * @property int    $delegue_id
 * @property int    $praticien_id
 * @property string $date_visite
 * @property string $statut  planifiee|confirmee|en_cours|realisee|annulee|manquee
 * @property string $notes
 * @property int    $duree_min
 */
class Visite extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'visites';

    protected $fillable = [
        'delegue_id',
        'praticien_id',
        'zone_id',
        'campagne_id',
        'date_visite',
        'heure_debut',
        'heure_fin',
        'statut',
        'motif_annulation',
        'annulee_par',
        'notes',
        'objectif',
        'produit_presente',
        'documentation_remise',
        'echantillons_remis',
        'nb_echantillons',
        'duree_min',
        'compte_rendu',
        'evaluation',
        'rapport_soumis_le',
        'rapport_valide_par',
        'rapport_valide_le',
        'latitude',
        'longitude',
        'adresse_visite',
    ];

    protected $casts = [
        'date_visite'          => 'datetime',
        'heure_debut'          => 'datetime',
        'heure_fin'            => 'datetime',
        'rapport_soumis_le'    => 'datetime',
        'rapport_valide_le'    => 'datetime',
        'documentation_remise' => 'boolean',
        'echantillons_remis'   => 'boolean',
        'latitude'             => 'decimal:8',
        'longitude'            => 'decimal:8',
        'evaluation'           => 'integer',
        'duree_min'            => 'integer',
        'nb_echantillons'      => 'integer',
    ];

    // ════════════════════════════════════════════════════════
    // RELATIONS — Carte #1 AB
    // ════════════════════════════════════════════════════════

    /**
     * La visite appartient à un délégué (User)
     * Carte #1 AB : belongsTo User (délégué)
     */
    public function delegue(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delegue_id');
    }

    /**
     * La visite appartient à un praticien
     * Carte #1 AB : belongsTo Praticien
     */
    public function praticien(): BelongsTo
    {
        return $this->belongsTo(Praticien::class, 'praticien_id');
    }

    /**
     * La visite appartient à une zone
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * La visite appartient à une campagne (optionnel)
     */
    public function campagne(): BelongsTo
    {
        return $this->belongsTo(Campagne::class);
    }

    /**
     * Qui a annulé la visite
     */
    public function annuleePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'annulee_par');
    }

    /**
     * Qui a validé le rapport
     */
    public function rapportValidePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rapport_valide_par');
    }

    // ════════════════════════════════════════════════════════
    // SCOPES — Carte #1 AB
    // parDelegue(), duMois()
    // ════════════════════════════════════════════════════════

    /**
     * Scope : filtrer par délégué
     * Carte #1 AB — scope parDelegue()
     */
    public function scopeParDelegue(Builder $query, int $delegueId): Builder
    {
        return $query->where('delegue_id', $delegueId);
    }

    /**
     * Scope : visites du mois en cours
     * Carte #1 AB — scope duMois()
     */
    public function scopeDuMois(Builder $query, ?int $mois = null, ?int $annee = null): Builder
    {
        $mois   = $mois   ?? now()->month;
        $annee  = $annee  ?? now()->year;

        return $query
            ->whereMonth('date_visite', $mois)
            ->whereYear('date_visite', $annee);
    }

    /**
     * Scope : visites du jour
     */
    public function scopeDuJour(Builder $query): Builder
    {
        return $query->whereDate('date_visite', today());
    }

    /**
     * Scope : visites de la semaine
     */
    public function scopeDeLaSemaine(Builder $query): Builder
    {
        return $query->whereBetween('date_visite', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ]);
    }

    /**
     * Scope : par statut
     */
    public function scopeParStatut(Builder $query, string $statut): Builder
    {
        return $query->where('statut', $statut);
    }

    /**
     * Scope : visites planifiées/confirmées (à venir)
     */
    public function scopeAVenir(Builder $query): Builder
    {
        return $query
            ->whereIn('statut', ['planifiee', 'confirmee'])
            ->where('date_visite', '>=', now())
            ->orderBy('date_visite');
    }

    /**
     * Scope : visites réalisées
     */
    public function scopeRealisees(Builder $query): Builder
    {
        return $query->where('statut', 'realisee');
    }

    /**
     * Scope : rapports en attente (réalisée mais pas encore soumis)
     */
    public function scopeRapportsEnAttente(Builder $query): Builder
    {
        return $query
            ->where('statut', 'realisee')
            ->whereNull('rapport_soumis_le');
    }

    /**
     * Scope : avec eager loading optimal (éviter N+1)
     * Carte #4 KG — with('praticien') · with('delegue')
     */
    public function scopeAvecRelations(Builder $query): Builder
    {
        return $query->with(['delegue', 'praticien', 'praticien.zone']);
    }

    // ════════════════════════════════════════════════════════
    // ACCESSORS / HELPERS
    // ════════════════════════════════════════════════════════

    /**
     * Retourne true si la visite est en retard (passée mais pas réalisée)
     */
    public function getEstEnRetardAttribute(): bool
    {
        return in_array($this->statut, ['planifiee', 'confirmee'])
            && $this->date_visite->isPast();
    }

    /**
     * Durée calculée si heure_debut et heure_fin sont renseignées
     */
    public function getDureeReelleAttribute(): ?int
    {
        if ($this->heure_debut && $this->heure_fin) {
            return $this->heure_debut->diffInMinutes($this->heure_fin);
        }
        return $this->duree_min;
    }

    /**
     * Libellé du statut pour l'affichage Blade
     */
    public function getStatutLabelAttribute(): string
    {
        return match($this->statut) {
            'planifiee'  => 'Planifiée',
            'confirmee'  => 'Confirmée',
            'en_cours'   => 'En cours',
            'realisee'   => 'Réalisée',
            'annulee'    => 'Annulée',
            'manquee'    => 'Manquée',
            default      => ucfirst($this->statut),
        };
    }

    /**
     * Couleur CSS Tailwind selon le statut (pour les badges Blade)
     */
    public function getStatutCouleurAttribute(): string
    {
        return match($this->statut) {
            'planifiee'  => 'bg-blue-100 text-blue-800',
            'confirmee'  => 'bg-green-100 text-green-800',
            'en_cours'   => 'bg-yellow-100 text-yellow-800',
            'realisee'   => 'bg-green-100 text-green-800',
            'annulee'    => 'bg-red-100 text-red-800',
            'manquee'    => 'bg-gray-100 text-gray-800',
            default      => 'bg-gray-100 text-gray-800',
        };
    }
}