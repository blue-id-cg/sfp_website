<?php

namespace App\Policies;

use App\Models\Trade;
use App\Models\User;

class TradePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function view(User $user, Trade $trade): bool
    {
        return $user->can('manage pages');
    }

    public function create(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function update(User $user, Trade $trade): bool
    {
        return $user->can('manage pages');
    }

    public function delete(User $user, Trade $trade): bool
    {
        return $user->can('manage pages');
    }
}
