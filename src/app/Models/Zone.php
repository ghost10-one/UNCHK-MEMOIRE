<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';

    protected $fillable = [
        'nom',
        'region',
        'code_postal',
        'ville_principale',
        'latitude',
        'longitude',
        'is_active',
    ];

    protected $casts = [
        'latitude'  => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean',
    ];

    // ════════════════════════════════════════════════════════
    // RELATIONS — Carte #3 AB
    // ════════════════════════════════════════════════════════

    /**
     * Une zone a plusieurs praticiens
     * Carte #3 AB : hasMany Praticiens
     */
    public function praticiens(): HasMany
    {
        return $this->hasMany(Praticien::class);
    }

    /**
     * Une zone a plusieurs utilisateurs (délégués affectés)
     * Carte #3 AB : hasMany Users
     */
    public function utilisateurs(): HasMany
    {
        return $this->hasMany(User::class, 'zone_id');
    }

    /**
     * Les délégués de cette zone
     */
    public function delegues(): HasMany
    {
        return $this->hasMany(User::class, 'zone_id')
                    ->where('role', 'delegate');
    }

    /**
     * Les visites dans cette zone
     */
    public function visites(): HasMany
    {
        return $this->hasMany(Visite::class);
    }

    // ════════════════════════════════════════════════════════
    // SCOPES — Carte #3 AB
    // ════════════════════════════════════════════════════════

    /**
     * Scope : zones actives seulement
     */
    public function scopeActives(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope : zones par région
     */
    public function scopeParRegion(Builder $query, string $region): Builder
    {
        return $query->where('region', $region);
    }

    /**
     * Scope : zones couvrant un délégué spécifique
     * Carte #3 AB — scope parDelegue()
     */
    public function scopeParDelegue(Builder $query, int $delegueId): Builder
    {
        return $query->whereHas('delegues', function (Builder $q) use ($delegueId) {
            $q->where('id', $delegueId);
        });
    }

    // ════════════════════════════════════════════════════════
    // ACCESSORS
    // ════════════════════════════════════════════════════════

    public function getNomCompletAttribute(): string
    {
        return "{$this->nom} ({$this->region})";
    }
}
