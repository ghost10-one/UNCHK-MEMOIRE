<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use App\Models\Zone;

class Campaign extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'date_debut',
        'date_fin',
        'statut',
        'delegue_id',
        'zone_id',
        'digital_support_path',
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
    ];

    public function scopeParZone($query, $zoneId)
    {
        return $query->where('zone_id', $zoneId);
    }

    public function delegue(): BelongsTo
    {
        return $this->belongsTo(User::class, 'delegue_id');
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function delegues(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'campaign_user', 'campaign_id', 'user_id');
    }
}
