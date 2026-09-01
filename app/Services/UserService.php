<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param  array<string, mixed>  $data  may include an optional 'role' key (role name)
     */
    public function create(array $data): User
    {
        $role = $data['role'] ?? null;

        $user = User::query()->create([
            ...collect($data)->except('role')->all(),
            'password' => Hash::make($data['password']),
        ]);

        if ($role !== null) {
            $user->syncRoles([$role]);
        }

        return $user;
    }

    /**
     * @param  array<string, mixed>  $data  may include an optional 'role' key; an empty/absent
     *                                      'password' leaves the current password unchanged
     */
    public function update(User $user, array $data): User
    {
        $role = $data['role'] ?? null;
        $attributes = collect($data)->except(['role', 'password'])->all();

        if (! empty($data['password'])) {
            $attributes['password'] = Hash::make($data['password']);
        }

        $user->update($attributes);

        if ($role !== null) {
            $user->syncRoles([$role]);
        }

        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
