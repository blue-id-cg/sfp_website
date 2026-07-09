<?php

namespace App\Policies;

use App\Models\Offre;
use App\Models\User;

class OffrePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Offre $offre): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Offre $offre): bool
    {
        return true;
    }

    public function delete(User $user, Offre $offre): bool
    {
        return true;
    }
}
