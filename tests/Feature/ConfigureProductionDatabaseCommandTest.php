<?php

use Spatie\Permission\Models\Permission;

test('configures the database and synchronizes production permissions idempotently', function () {
    $this->artisan('app:configure-production-database')
        ->assertExitCode(0);

    expect(Permission::query()->where('name', 'manage settings')->count())->toBe(1);

    $this->artisan('app:configure-production-database')
        ->assertExitCode(0);

    expect(Permission::query()->where('name', 'manage settings')->count())->toBe(1);
});
