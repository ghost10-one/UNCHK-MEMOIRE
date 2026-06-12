<?php

namespace App\Policies;

use App\Models\Tournee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * ╔══════════════════════════════════════════════════════════════╗
 * ║  SPRINT 2 · AB — Carte #3                                   ║
 * ║  TourneePolicy — Checklist : policy Gate                    ║
 * ╚══════════════════════════════════════════════════════════════╝
 */
class TourneePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager', 'delegate']);
    }

    /** Un délégué ne voit que ses propres tournées */
    public function view(User $user, Tournee $tournee): bool
    {
        if ($user->isDelegate()) {
            return $tournee->delegue_id === $user->id;
        }
        return in_array($user->role, ['admin', 'manager']);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager', 'delegate']);
    }

    /** Un délégué ne modifie que ses tournées planifiées */
    public function update(User $user, Tournee $tournee): bool
    {
        if ($user->isDelegate()) {
            return $tournee->delegue_id === $user->id
                && in_array($tournee->statut, ['planifiee', 'en_cours']);
        }
        return in_array($user->role, ['admin', 'manager']);
    }

    public function delete(User $user, Tournee $tournee): bool
    {
        return $user->role === 'admin'
            || ($user->isManager())
            || ($user->isDelegate() && $tournee->delegue_id === $user->id && $tournee->statut === 'planifiee');
    }
}