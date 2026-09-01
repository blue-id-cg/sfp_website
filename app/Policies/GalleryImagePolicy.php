<?php

namespace App\Policies;

use App\Models\GalleryImage;
use App\Models\User;

class GalleryImagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage gallery');
    }

    public function view(User $user, GalleryImage $galleryImage): bool
    {
        return $user->can('manage gallery');
    }

    public function create(User $user): bool
    {
        return $user->can('manage gallery');
    }

    public function update(User $user, GalleryImage $galleryImage): bool
    {
        return $user->can('manage gallery');
    }

    public function delete(User $user, GalleryImage $galleryImage): bool
    {
        return $user->can('manage gallery');
    }
}
