<?php

use App\Models\Trade;
use App\Models\User;

test('guests cannot access the admin trades list', function () {
    $response = $this->get('/admin/trades');

    $response->assertRedirect('/login');
});

test('an authenticated user can list trades', function () {
    $user = User::factory()->create();
    Trade::factory()->count(3)->create();

    $response = $this->actingAs($user)->get('/admin/trades');

    $response->assertOk();
});

test('an authenticated user can create a trade', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/trades', [
        'title' => 'Nouveau métier',
        'icon' => 'hgi-factory-01',
        'description' => 'Un résumé du métier.',
        'body' => '<p>Le détail du métier en <strong>gras</strong>.</p>',
        'position' => 1,
    ]);

    $response->assertRedirect(route('admin.trades.index'));

    $trade = Trade::query()->where('title', 'Nouveau métier')->first();
    expect($trade)->not->toBeNull();
    expect($trade->slug)->toBe('nouveau-metier');
});

test('the trade body is sanitized against XSS when created', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post('/admin/trades', [
        'title' => 'Métier avec contenu suspect',
        'body' => '<p>Bonjour</p><script>alert(1)</script><img src=x onerror=alert(2)>',
    ]);

    $trade = Trade::query()->where('title', 'Métier avec contenu suspect')->first();

    expect($trade->body)->toBe('<p>Bonjour</p>');
});

test('creating a trade requires a title', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/trades', []);

    $response->assertSessionHasErrors(['title']);
});

test('an authenticated user can update a trade', function () {
    $user = User::factory()->create();
    $trade = Trade::factory()->create(['title' => 'Ancien titre']);

    $response = $this->actingAs($user)->put("/admin/trades/{$trade->slug}", [
        'title' => 'Titre modifié',
        'icon' => $trade->icon,
        'description' => $trade->description,
        'body' => $trade->body,
    ]);

    $response->assertRedirect(route('admin.trades.index'));
    expect($trade->refresh()->title)->toBe('Titre modifié');
});

test('an authenticated user can delete a trade', function () {
    $user = User::factory()->create();
    $trade = Trade::factory()->create();

    $response = $this->actingAs($user)->delete("/admin/trades/{$trade->slug}");

    $response->assertRedirect(route('admin.trades.index'));
    $this->assertModelMissing($trade);
});
