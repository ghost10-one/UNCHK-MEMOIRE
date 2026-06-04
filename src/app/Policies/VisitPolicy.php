<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Visit;
use Illuminate\Auth\Access\Response;

class VisitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole([User::ROLE_MANAGER, User::ROLE_DELEGATE, User::ROLE_PRO_SANTÉ]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Visit $visit): bool
    {
        if ($user->hasRole(User::ROLE_MANAGER)) {
            return true;
        }

        return $visit->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_visits');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Visit $visit): bool
    {
        if ($user->hasRole(User::ROLE_MANAGER)) {
            return true;
        }

        return $user->can('edit_visits') && $visit->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Visit $visit): bool
    {
        if ($user->hasRole(User::ROLE_MANAGER)) {
            return true;
        }

        return $user->can('delete_visits') && $visit->user_id === $user->id;
    }
}
