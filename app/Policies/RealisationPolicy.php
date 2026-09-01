<?php

namespace App\Policies;

use App\Models\Realisation;
use App\Models\User;

class RealisationPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function view(User $user, Realisation $realisation): bool
    {
        return $user->can('manage pages');
    }

    public function create(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function update(User $user, Realisation $realisation): bool
    {
        return $user->can('manage pages');
    }

    public function delete(User $user, Realisation $realisation): bool
    {
        return $user->can('manage pages');
    }
}
