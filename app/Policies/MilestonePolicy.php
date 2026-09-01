<?php

namespace App\Policies;

use App\Models\Milestone;
use App\Models\User;

class MilestonePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function view(User $user, Milestone $milestone): bool
    {
        return $user->can('manage pages');
    }

    public function create(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function update(User $user, Milestone $milestone): bool
    {
        return $user->can('manage pages');
    }

    public function delete(User $user, Milestone $milestone): bool
    {
        return $user->can('manage pages');
    }
}
