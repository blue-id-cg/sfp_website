<?php

use App\Models\Offre;
use App\Models\User;

test('guests cannot access the admin offres list', function () {
    $response = $this->get('/admin/offres');

    $response->assertRedirect('/login');
});

test('an authenticated user can create an offre with newline-separated lists', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/offres', [
        'title' => 'Ingénieur process',
        'tags' => "Brazzaville\nCDI",
        'summary' => 'Un résumé',
        'missions' => "Mission 1\nMission 2",
        'profile' => "Critère 1\nCritère 2",
        'published_at' => now()->format('Y-m-d'),
    ]);

    $response->assertRedirect(route('admin.offres.index'));

    $offre = Offre::query()->where('title', 'Ingénieur process')->first();
    expect($offre)->not->toBeNull();
    expect($offre->tags)->toBe(['Brazzaville', 'CDI']);
    expect($offre->missions)->toBe(['Mission 1', 'Mission 2']);
    expect($offre->profile)->toBe(['Critère 1', 'Critère 2']);
});

test('an authenticated user can update an offre', function () {
    $user = User::factory()->create();
    $offre = Offre::factory()->create(['title' => 'Ancien poste']);

    $response = $this->actingAs($user)->put("/admin/offres/{$offre->slug}", [
        'title' => 'Nouveau poste',
        'summary' => $offre->summary,
        'published_at' => $offre->published_at->format('Y-m-d'),
    ]);

    $response->assertRedirect(route('admin.offres.index'));
    expect($offre->refresh()->title)->toBe('Nouveau poste');
});

test('an authenticated user can delete an offre', function () {
    $user = User::factory()->create();
    $offre = Offre::factory()->create();

    $response = $this->actingAs($user)->delete("/admin/offres/{$offre->slug}");

    $response->assertRedirect(route('admin.offres.index'));
    $this->assertModelMissing($offre);
});
