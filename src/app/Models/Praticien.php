<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * ============================================================
 * SPRINT 1 — AB (Abibou Ndione)
 * Modèle Praticien + relations + scopes
 * Carte #2 — hasMany Visites · belongsTo Zone
 *             fillable défini · casts dates
 *             factory Praticien · test hasMany · recherche fulltext
 * ============================================================
 */
class Praticien extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'praticiens';

    protected $fillable = [
        'nom',
        'prenom',
        'titre',
        'specialite',
        'sous_specialite',
        'telephone',
        'email',
        'email_secondaire',
        'adresse',
        'ville',
        'code_postal',
        'latitude',
        'longitude',
        'hopital',
        'cabinet',
        'type_etablissement',
        'zone_id',
        'jours_visite_preferes',
        'heure_visite_preferee',
        'notes',
        'is_active',
        'nb_visites_total',
        'derniere_visite_le',
    ];

    protected $casts = [
        'latitude'             => 'decimal:8',
        'longitude'            => 'decimal:8',
        'is_active'            => 'boolean',
        'nb_visites_total'     => 'integer',
        'derniere_visite_le'   => 'date',         // cast date (Carte #2 AB)
        'jours_visite_preferes' => 'array',
    ];

    // ════════════════════════════════════════════════════════
    // RELATIONS — Carte #2 AB
    // ════════════════════════════════════════════════════════

    /**
     * Un praticien a plusieurs visites
     * Carte #2 AB : hasMany Visites
     */
    public function visites(): HasMany
    {
        return $this->hasMany(Visite::class, 'praticien_id');
    }

    /**
     * Un praticien appartient à une zone
     * Carte #2 AB : belongsTo Zone
     */
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    // ════════════════════════════════════════════════════════
    // SCOPES — Carte #2 AB + Carte #5 KG (filtre & recherche)
    // ════════════════════════════════════════════════════════

    /**
     * Scope : praticiens actifs seulement
     */
    public function scopeActifs(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope : filtrer par spécialité
     * Carte #5 KG — recherche par spécialité
     */
    public function scopeParSpecialite(Builder $query, string $specialite): Builder
    {
        return $query->where('specialite', 'ILIKE', "%{$specialite}%");
    }

    /**
     * Scope : filtrer par zone
     * Carte #5 KG — recherche par zone
     */
    public function scopeParZone(Builder $query, int $zoneId): Builder
    {
        return $query->where('zone_id', $zoneId);
    }

    /**
     * Scope : recherche fulltext par nom/prénom
     * Carte #2 AB — recherche fulltext
     * Carte #5 KG — recherche par nom
     */
    public function scopeRecherche(Builder $query, string $terme): Builder
    {
        $terme = trim($terme);
        return $query->where(function (Builder $q) use ($terme) {
            $q->where('nom',        'ILIKE', "%{$terme}%")
              ->orWhere('prenom',   'ILIKE', "%{$terme}%")
              ->orWhere('specialite','ILIKE', "%{$terme}%")
              ->orWhere('hopital',  'ILIKE', "%{$terme}%")
              ->orWhere('cabinet',  'ILIKE', "%{$terme}%")
              ->orWhere('ville',    'ILIKE', "%{$terme}%");
        });
    }

    /**
     * Scope combiné : recherche + spécialité + zone
     * Carte #5 KG — filtre vide/rempli géré ici
     */
    public function scopeFiltre(
        Builder $query,
        ?string $recherche = null,
        ?string $specialite = null,
        ?int    $zoneId = null,
        bool    $actifsOnly = true
    ): Builder {
        if ($actifsOnly) {
            $query->actifs();
        }
        if ($recherche) {
            $query->recherche($recherche);
        }
        if ($specialite) {
            $query->parSpecialite($specialite);
        }
        if ($zoneId) {
            $query->parZone($zoneId);
        }
        return $query;
    }

    // ════════════════════════════════════════════════════════
    // ACCESSORS
    // ════════════════════════════════════════════════════════

    /**
     * Nom complet avec titre
     */
    public function getNomCompletAttribute(): string
    {
        return "{$this->titre} {$this->prenom} {$this->nom}";
    }

    /**
     * Établissement principal (hôpital ou cabinet)
     */
    public function getEtablissementAttribute(): string
    {
        return $this->hopital ?? $this->cabinet ?? 'Non renseigné';
    }

    /**
     * Adresse complète
     */
    public function getAdresseCompleteAttribute(): string
    {
        $parts = array_filter([$this->adresse, $this->ville, $this->code_postal]);
        return implode(', ', $parts);
    }

    /**
     * Coordonnées GPS
     */
    public function getCoordonneesgpsAttribute(): array
    {
        return [
            'lat' => $this->latitude,
            'lng' => $this->longitude,
        ];
    }
}