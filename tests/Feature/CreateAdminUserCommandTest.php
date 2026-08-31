<?php

use App\Models\User;

test('it creates an admin user from command options', function () {
    $this->artisan('app:create-admin-user', [
        '--name' => 'Nouvel Admin',
        '--email' => 'nouvel.admin@example.com',
        '--password' => 'Sup3rSecret!23',
    ])->assertExitCode(0);

    $user = User::query()->where('email', 'nouvel.admin@example.com')->first();
    expect($user)->not->toBeNull();
    expect($user->name)->toBe('Nouvel Admin');
    expect($user->password)->not->toBe('Sup3rSecret!23');
});

test('it rejects an already-used email', function () {
    User::factory()->create(['email' => 'taken@example.com']);

    $this->artisan('app:create-admin-user', [
        '--name' => 'Doublon',
        '--email' => 'taken@example.com',
        '--password' => 'Sup3rSecret!23',
    ])->assertExitCode(1);
});

test('it rejects a weak password', function () {
    $this->artisan('app:create-admin-user', [
        '--name' => 'Faible',
        '--email' => 'faible@example.com',
        '--password' => '123',
    ])->assertExitCode(1);

    $this->assertDatabaseMissing('users', ['email' => 'faible@example.com']);
});

test('it prompts interactively when no options are given', function () {
    $this->artisan('app:create-admin-user')
        ->expectsQuestion('Nom complet', 'Admin Interactif')
        ->expectsQuestion('Adresse email', 'interactif@example.com')
        ->expectsQuestion('Mot de passe', 'Sup3rSecret!23')
        ->assertExitCode(0);

    expect(User::query()->where('email', 'interactif@example.com')->exists())->toBeTrue();
});
