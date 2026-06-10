<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
 protected $fillable = [
'titre',
'description',
'date_debut',
'date_fin',
'delegue_id',
'zone_id',
'digital_support_path'
];

public function scopeParZone($query, $zoneId)
{
return $query->where('zone_id', $zoneId);
}
   //
}
