<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'message_id',   // Lié à quel message
        'filename',     // Nom du fichier ex: rapport.pdf
        'path',         // Chemin du fichier sur le serveur
        'mime_type',    // Type ex: application/pdf
        'size'          // Taille en octets
    ];

    // La pièce jointe appartient à un message
    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    // Obtenir la taille en format lisible (ex: 2.5 MB)
    public function getFormattedSizeAttribute()
    {
        $size = $this->size;
        if ($size < 1024) return $size . ' B';
        if ($size < 1048576) return round($size / 1024, 1) . ' KB';
        return round($size / 1048576, 1) . ' MB';
    }
}