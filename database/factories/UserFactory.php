<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Factory users are admins by default, matching this app's historical "any authenticated
     * user has full access" behaviour. Use the editor() state to test role restrictions.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole(Role::findOrCreate('admin'));
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the user has the "editor" role instead of "admin".
     */
    public function editor(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->syncRoles([Role::findOrCreate('editor')]);
        });
    }
}
