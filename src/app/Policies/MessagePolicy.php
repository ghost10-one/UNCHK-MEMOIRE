<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;

class MessagePolicy
{
    // Voir un message
    public function view(User $user, Message $message): bool
    {
        return $user->id === $message->receiver_id 
            || $user->id === $message->sender_id;
    }

    // Archiver un message
    public function update(User $user, Message $message): bool
    {
        return $user->id === $message->receiver_id;
    }
}