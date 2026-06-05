<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'specialty', 'establishment_id', 'address', 'phone', 'email', 'zone_id'];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function getFullNameAttribute()
    {
        return "Dr. {$this->first_name} {$this->last_name}";
    }
}
