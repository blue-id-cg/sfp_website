<?php

namespace App\Policies;

use App\Models\Actualite;
use App\Models\User;

class ActualitePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage actualites');
    }

    public function view(User $user, Actualite $actualite): bool
    {
        return $user->can('manage actualites');
    }

    public function create(User $user): bool
    {
        return $user->can('manage actualites');
    }

    public function update(User $user, Actualite $actualite): bool
    {
        return $user->can('manage actualites');
    }

    public function delete(User $user, Actualite $actualite): bool
    {
        return $user->can('manage actualites');
    }
}
