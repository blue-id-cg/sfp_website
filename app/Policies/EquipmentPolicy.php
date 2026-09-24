<?php

namespace App\Policies;

use App\Models\Equipment;
use App\Models\User;

class EquipmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function view(User $user, Equipment $equipment): bool
    {
        return $user->can('manage pages');
    }

    public function create(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function update(User $user, Equipment $equipment): bool
    {
        return $user->can('manage pages');
    }

    public function delete(User $user, Equipment $equipment): bool
    {
        return $user->can('manage pages');
    }
}
