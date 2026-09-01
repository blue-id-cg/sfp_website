<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Permissions reserved to the "admin" role — team and site-wide configuration.
     *
     * @var list<string>
     */
    private const ADMIN_ONLY_PERMISSIONS = [
        'manage users',
        'manage roles',
        'manage settings',
    ];

    /**
     * Permissions available to both "admin" and "editor" — day-to-day content management.
     *
     * @var list<string>
     */
    private const CONTENT_PERMISSIONS = [
        'manage actualites',
        'manage offres',
        'manage gallery',
        'manage media',
        'manage pages',
        'view messages',
        'delete messages',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allPermissions = [...self::ADMIN_ONLY_PERMISSIONS, ...self::CONTENT_PERMISSIONS];

        foreach ($allPermissions as $permission) {
            Permission::findOrCreate($permission);
        }

        Role::findOrCreate('admin')->syncPermissions($allPermissions);
        Role::findOrCreate('editor')->syncPermissions(self::CONTENT_PERMISSIONS);

        // Backfill: users created before roles existed keep full access rather than being
        // silently locked out once policies start checking permissions.
        User::query()->whereDoesntHave('roles')->get()->each(
            fn (User $user) => $user->assignRole('admin')
        );
    }
}
