<?php

namespace App\Policies;

use App\Models\Praticien;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PraticienPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Tous les utilisateurs connectés peuvent voir la liste
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Praticien $praticien): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Seuls les admins ou certains rôles peuvent créer, ou tout le monde selon les règles métier
        return true; 
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Praticien $praticien): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Praticien $praticien): bool
    {
        return $user->role === 'admin'; // Par exemple, seul l'admin peut supprimer
    }
}
