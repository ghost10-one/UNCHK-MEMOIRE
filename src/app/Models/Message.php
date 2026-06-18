<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sender_id',      // Expéditeur
        'receiver_id',    // Destinataire
        'subject',        // Sujet
        'body',           // Contenu
        'is_read',        // Lu ou non
        'is_archived',    // Archivé ou non
        'read_at'         // Date de lecture
    ];

    protected $casts = [
        'is_read'     => 'boolean',   // Convertir en vrai/faux
        'is_archived' => 'boolean',   // Convertir en vrai/faux
        'read_at'     => 'datetime',  // Convertir en date
    ];

    // Qui a envoyé le message
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Qui reçoit le message
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Les pièces jointes du message
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    // Marquer le message comme lu
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    // Marquer le message comme non lu
    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }
}