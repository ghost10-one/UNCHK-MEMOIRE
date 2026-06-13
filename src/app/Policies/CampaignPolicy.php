<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\User;

class CampaignPolicy
{
    public function before(User $user, string $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['manager', 'admin']);
    }

    public function view(User $user, Campaign $campaign): bool
    {
        return $user->hasAnyRole(['manager', 'admin']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('manager');
    }

    public function update(User $user, Campaign $campaign): bool
    {
        return $user->hasRole('manager');
    }

    public function delete(User $user, Campaign $campaign): bool
    {
        return $user->hasRole('manager');
    }
}
