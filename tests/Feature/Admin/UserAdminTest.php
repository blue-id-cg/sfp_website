<?php

use App\Models\User;

test('guests cannot access the admin users list', function () {
    $response = $this->get('/admin/users');

    $response->assertRedirect('/login');
});

test('an authenticated user can list users', function () {
    $user = User::factory()->create();
    User::factory()->count(2)->create();

    $response = $this->actingAs($user)->get('/admin/users');

    $response->assertOk();
});

test('an authenticated user can create another admin user', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/users', [
        'name' => 'Nouvel Admin',
        'email' => 'nouvel.admin@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect(route('admin.users.index'));

    $newUser = User::query()->where('email', 'nouvel.admin@example.com')->first();
    expect($newUser)->not->toBeNull();
    expect($newUser->name)->toBe('Nouvel Admin');
});

test('creating a user requires a name, unique email and confirmed password', function () {
    $existing = User::factory()->create(['email' => 'taken@example.com']);
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/users', [
        'name' => '',
        'email' => 'taken@example.com',
        'password' => 'password123',
        'password_confirmation' => 'mismatch',
    ]);

    $response->assertSessionHasErrors(['name', 'email', 'password']);
});
