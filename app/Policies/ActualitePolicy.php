<?php

namespace App\Policies;

use App\Models\Actualite;
use App\Models\User;

class ActualitePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Actualite $actualite): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Actualite $actualite): bool
    {
        return true;
    }

    public function delete(User $user, Actualite $actualite): bool
    {
        return true;
    }
}
