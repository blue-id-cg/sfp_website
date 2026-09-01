<?php

use App\Models\SiteSetting;
use App\Models\User;

test('guests cannot access the site settings screen', function () {
    $response = $this->get('/admin/settings');

    $response->assertRedirect('/login');
});

test('an authenticated user can view and update site settings', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/admin/settings');
    $response->assertOk();

    $response = $this->actingAs($user)->put('/admin/settings', [
        'contact_email' => 'nouveau@snpc-sfp.net',
        'founding_year' => 2012,
        'rigs_count' => 3,
        'incidents_count' => 0,
    ]);

    $response->assertRedirect(route('admin.settings.edit'));
    expect(SiteSetting::current()->contact_email)->toBe('nouveau@snpc-sfp.net');
    expect(SiteSetting::current()->rigs_count)->toBe(3);
});
