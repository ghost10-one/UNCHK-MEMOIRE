<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  SPRINT 2 · AB — Abibou Ndione · Carte Trello #2            ║
 * ║  Modèle Tournee + relations + scopes                        ║
 * ║                                                              ║
 * ║  Tâche :                                                     ║
 * ║    - belongsTo User (délégué)                                ║
 * ║    - hasMany Visites via pivot visite_tournee               ║
 * ║    - scope enCours()                                         ║
 * ║    - scope duMois()                                          ║
 * ║    - scope parDelegue()                                      ║
 * ║                                                              ║
 * ║  Checklist :                                                 ║
 * ║    ✓ factory Tournee    → TourneeFactory.php               ║
 * ║    ✓ test relations     → TourneeTest.php                  ║
 * ║    ✓ scope filtre       → TourneeTest.php                  ║
 * ╚══════════════════════════════════════════════════════════════╝
 *
 * @property int             $id
 * @property int             $delegue_id
 * @property \Carbon\Carbon  $date_debut
 * @property \Carbon\Carbon  $date_fin
 * @property string          $statut      planifiee|en_cours|terminee|annulee
 * @property string|null     $titre
 * @property int|null        $zone_id
 * @property float|null      $distance_totale_km
 * @property int|null        $duree_estimee_min
 * @property int             $nb_visites_prevues
 * @property int             $nb_visites_realisees
 */
class Tournee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tournees';

    protected $fillable = [
        'delegue_id',
        'zone_id',
        'titre',
        'date_debut',
        'date_fin',
        'heure_debut',
        'heure_fin',
        'statut',
        'notes',
        'motif_annulation',
        'nb_visites_prevues',
        'nb_visites_realisees',
        'distance_totale_km',
        'duree_estimee_min',
    ];

    protected $casts = [
        'date_debut'           => 'date',
        'date_fin'             => 'date',
        'nb_visites_prevues'   => 'integer',
        'nb_visites_realisees' => 'integer',
        'distance_totale_km'   => 'decimal:2',
        'duree_estimee_min'    => 'integer',
    ];

    // ════════════════════════════════════════════════════════
    // RELATIONS — Carte #2 AB
    // ════════════════════════════════════════════════════════

    /**
     * La tournée appartient à un délégué.
     * Carte #2 AB : belongsTo User (délégué)
     */
    public function delegue(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delegue_id');
    }

    /**
     * La tournée appartient à une zone géographique.
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    /**
     * Les visites associées à la tournée via la table pivot.
     * Carte #2 AB : hasMany Visites via pivot visite_tournee
     *
     * Colonnes pivot accessibles : ordre, distance_depuis_precedent_km, duree_trajet_min
     */
    public function visites(): BelongsToMany
    {
        return $this->belongsToMany(
            Visite::class,
            'visite_tournee',
            'tournee_id',
            'visite_id'
        )
        ->withPivot(['ordre', 'distance_depuis_precedent_km', 'duree_trajet_min'])
        ->withTimestamps()
        ->orderByPivot('ordre');
    }

    /**
     * Visites confirmées de la tournée (sous-ensemble).
     */
    public function visitesConfirmees(): BelongsToMany
    {
        return $this->visites()->where('visites.statut', 'confirmee');
    }

    /**
     * Visites réalisées de la tournée (pour calcul avancement).
     */
    public function visitesRealisees(): BelongsToMany
    {
        return $this->visites()->where('visites.statut', 'realisee');
    }

    // ════════════════════════════════════════════════════════
    // SCOPES — Carte #2 AB : enCours(), duMois(), parDelegue()
    // ════════════════════════════════════════════════════════

    /**
     * Scope : enCours()
     * Carte #2 AB — tournées dont la plage date_debut–date_fin
     * inclut aujourd'hui ET qui ne sont pas annulées.
     *
     * Usage : Tournee::enCours()->get()
     */
    public function scopeEnCours(Builder $query): Builder
    {
        return $query->where('statut', 'en_cours')
                     ->orWhere(function (Builder $q) {
                         $q->where('statut', 'planifiee')
                           ->whereDate('date_debut', '<=', today())
                           ->whereDate('date_fin',   '>=', today());
                     });
    }

    /**
     * Scope : duMois()
     * Carte #2 AB — tournées dont la date_debut est dans le mois cible.
     *
     * Usage : Tournee::duMois()->get()
     *       : Tournee::duMois(1, 2026)->get()
     */
    public function scopeDuMois(
        Builder $query,
        ?int $mois  = null,
        ?int $annee = null,
    ): Builder {
        $mois  = $mois  ?? now()->month;
        $annee = $annee ?? now()->year;

        return $query
            ->whereMonth('date_debut', $mois)
            ->whereYear('date_debut',  $annee);
    }

    /**
     * Scope : parDelegue()
     * Carte #2 AB — tournées d'un délégué spécifique.
     *
     * Usage : Tournee::parDelegue($delegueId)->get()
     */
    public function scopeParDelegue(Builder $query, int $delegueId): Builder
    {
        return $query->where('delegue_id', $delegueId);
    }

    /**
     * Scope : planifiees — tournées futures non démarrées.
     */
    public function scopePlanifiees(Builder $query): Builder
    {
        return $query->where('statut', 'planifiee')
                     ->whereDate('date_debut', '>=', today());
    }

    /**
     * Scope : terminées.
     */
    public function scopeTerminees(Builder $query): Builder
    {
        return $query->where('statut', 'terminee');
    }

    /**
     * Scope : non annulées.
     */
    public function scopeActives(Builder $query): Builder
    {
        return $query->whereIn('statut', ['planifiee', 'en_cours', 'terminee']);
    }

    /**
     * Scope : eager loading optimal (évite N+1 sur les listes).
     */
    public function scopeAvecRelations(Builder $query): Builder
    {
        return $query->with([
            'delegue:id,name,email',
            'zone:id,nom,region',
            'visites:id,date_visite,statut,praticien_id',
            'visites.praticien:id,nom,prenom,titre,specialite,hopital,latitude,longitude',
        ]);
    }

    // ════════════════════════════════════════════════════════
    // MÉTHODES MÉTIER
    // ════════════════════════════════════════════════════════

    /**
     * Vérifie si une nouvelle tournée chevauche une existante pour ce délégué.
     * Carte #3 AB — Checklist : chevauchement interdit
     *
     * @param int    $delegueId
     * @param string $dateDebut  format Y-m-d
     * @param string $dateFin    format Y-m-d
     * @param int|null $excludeId  exclure la tournée courante (pour l'update)
     */
    public static function chevauchementExiste(
        int    $delegueId,
        string $dateDebut,
        string $dateFin,
        ?int   $excludeId = null,
    ): bool {
        return static::where('delegue_id', $delegueId)
            ->whereNotIn('statut', ['annulee'])
            ->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))
            ->where(function (Builder $q) use ($dateDebut, $dateFin) {
                // chevauchement si les plages se croisent
                $q->where('date_debut', '<=', $dateFin)
                  ->where('date_fin',   '>=', $dateDebut);
            })
            ->exists();
    }

    /**
     * Calcule le taux d'avancement de la tournée (%).
     */
    public function tauxAvancement(): float
    {
        if ($this->nb_visites_prevues === 0) {
            return 0.0;
        }

        return round(
            ($this->nb_visites_realisees / $this->nb_visites_prevues) * 100,
            1
        );
    }

    /**
     * Met à jour les compteurs de visites après chaque changement de statut.
     */
    public function recalculerCompteurs(): void
    {
        $this->update([
            'nb_visites_prevues'   => $this->visites()->count(),
            'nb_visites_realisees' => $this->visitesRealisees()->count(),
        ]);
    }

    // ════════════════════════════════════════════════════════
    // ACCESSORS
    // ════════════════════════════════════════════════════════

    /**
     * Libellé français du statut.
     */
    public function getStatutLabelAttribute(): string
    {
        return match ($this->statut) {
            'planifiee' => 'Planifiée',
            'en_cours'  => 'En cours',
            'terminee'  => 'Terminée',
            'annulee'   => 'Annulée',
            default     => ucfirst($this->statut),
        };
    }

    /**
     * Couleurs CSS Tailwind pour les badges.
     */
    public function getStatutCouleurAttribute(): string
    {
        return match ($this->statut) {
            'planifiee' => 'bg-blue-100 text-blue-800',
            'en_cours'  => 'bg-yellow-100 text-yellow-800',
            'terminee'  => 'bg-green-100 text-green-800',
            'annulee'   => 'bg-red-100 text-red-800',
            default     => 'bg-gray-100 text-gray-700',
        };
    }

    /**
     * Durée de la tournée en jours.
     */
    public function getDureeJoursAttribute(): int
    {
        return (int) $this->date_debut->diffInDays($this->date_fin) + 1;
    }

    /**
     * Titre affiché (fallback sur les dates si titre vide).
     */
    public function getTitreLabelAttribute(): string
    {
        return $this->titre
            ?? 'Tournée du ' . $this->date_debut->format('d/m') . ' au ' . $this->date_fin->format('d/m/Y');
    }

    /**
     * Durée estimée formatée "1h 35min".
     */
    public function getDureeFormateeAttribute(): string
    {
        if (!$this->duree_estimee_min) {
            return '—';
        }

        $h   = intdiv($this->duree_estimee_min, 60);
        $min = $this->duree_estimee_min % 60;

        return $h > 0 ? "{$h}h {$min}min" : "{$min}min";
    }
}