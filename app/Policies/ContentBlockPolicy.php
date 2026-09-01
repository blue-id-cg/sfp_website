<?php

namespace App\Policies;

use App\Models\ContentBlock;
use App\Models\User;

class ContentBlockPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function view(User $user, ContentBlock $contentBlock): bool
    {
        return $user->can('manage pages');
    }

    public function create(User $user): bool
    {
        return $user->can('manage pages');
    }

    public function update(User $user, ContentBlock $contentBlock): bool
    {
        return $user->can('manage pages');
    }

    public function delete(User $user, ContentBlock $contentBlock): bool
    {
        return $user->can('manage pages');
    }
}
