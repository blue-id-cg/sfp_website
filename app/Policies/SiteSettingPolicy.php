<?php

namespace App\Policies;

use App\Models\SiteSetting;
use App\Models\User;

class SiteSettingPolicy
{
    public function view(User $user, SiteSetting $siteSetting): bool
    {
        return $user->can('manage settings');
    }

    public function update(User $user, SiteSetting $siteSetting): bool
    {
        return $user->can('manage settings');
    }
}
