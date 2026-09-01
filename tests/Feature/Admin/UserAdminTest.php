<?php

use App\Models\User;

test('guests cannot access the admin users list', function () {
    $response = $this->get('/admin/users');

    $response->assertRedirect('/login');
});

test('an authenticated admin can list users', function () {
    $user = User::factory()->create();
    User::factory()->count(2)->create();

    $response = $this->actingAs($user)->get('/admin/users');

    $response->assertOk();
});

test('an editor cannot access the admin users list', function () {
    $editor = User::factory()->editor()->create();

    $response = $this->actingAs($editor)->get('/admin/users');

    $response->assertForbidden();
});

test('an authenticated admin can create another user with a role', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/users', [
        'name' => 'Nouvel Admin',
        'email' => 'nouvel.admin@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'editor',
    ]);

    $response->assertRedirect(route('admin.users.index'));

    $newUser = User::query()->where('email', 'nouvel.admin@example.com')->first();
    expect($newUser)->not->toBeNull();
    expect($newUser->name)->toBe('Nouvel Admin');
    expect($newUser->hasRole('editor'))->toBeTrue();
});

test('creating a user requires a name, unique email, confirmed password and a role', function () {
    $existing = User::factory()->create(['email' => 'taken@example.com']);
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/users', [
        'name' => '',
        'email' => 'taken@example.com',
        'password' => 'password123',
        'password_confirmation' => 'mismatch',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'password', 'role']);
});

test('an authenticated admin can update another user', function () {
    $user = User::factory()->create();
    $other = User::factory()->editor()->create(['name' => 'Ancien nom']);

    $response = $this->actingAs($user)->put("/admin/users/{$other->id}", [
        'name' => 'Nouveau nom',
        'email' => $other->email,
        'role' => 'admin',
    ]);

    $response->assertRedirect(route('admin.users.index'));
    expect($other->refresh()->name)->toBe('Nouveau nom');
    expect($other->hasRole('admin'))->toBeTrue();
});

test('leaving the password blank on update keeps the current password', function () {
    $user = User::factory()->create();
    $other = User::factory()->editor()->create();
    $originalHash = $other->password;

    $this->actingAs($user)->put("/admin/users/{$other->id}", [
        'name' => $other->name,
        'email' => $other->email,
        'role' => 'editor',
    ]);

    expect($other->refresh()->password)->toBe($originalHash);
});

test('an authenticated admin can delete another user', function () {
    $user = User::factory()->create();
    $other = User::factory()->editor()->create();

    $response = $this->actingAs($user)->delete("/admin/users/{$other->id}");

    $response->assertRedirect(route('admin.users.index'));
    $this->assertModelMissing($other);
});

test('an admin cannot delete their own account', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->delete("/admin/users/{$user->id}");

    $response->assertRedirect();
    $this->assertModelExists($user);
});

test('the last remaining admin cannot be deleted, even by someone else', function () {
    $lastAdmin = User::factory()->create();
    // A distinct actor with the permission but not the "admin" role, so deleting $lastAdmin
    // is exercised without also tripping the separate "can't delete yourself" guard.
    $actor = User::factory()->editor()->create();
    $actor->givePermissionTo('manage users');

    $response = $this->actingAs($actor)->delete("/admin/users/{$lastAdmin->id}");

    $response->assertRedirect();
    $this->assertModelExists($lastAdmin);
});
