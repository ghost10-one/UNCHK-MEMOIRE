<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Establishment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'address', 'city', 'latitude', 'longitude'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
