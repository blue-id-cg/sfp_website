<?php

use App\Models\Realisation;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guests cannot access the admin realisations list', function () {
    $response = $this->get('/admin/realisations');

    $response->assertRedirect('/login');
});

test('an authenticated user can create a realisation with facts and tags', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/realisations', [
        'title' => 'Forage de puits à Youbi',
        'category' => 'Forage · Onshore',
        'description' => 'Un résumé',
        'image' => UploadedFile::fake()->image('photo.jpg'),
        'facts' => "hgi-location-01|Youbi\nSite unique",
        'tags' => "Mud logging\nCTR",
        'published_at' => now()->format('Y-m-d'),
    ]);

    $response->assertRedirect(route('admin.realisations.index'));

    $realisation = Realisation::query()->where('title', 'Forage de puits à Youbi')->first();
    expect($realisation)->not->toBeNull();
    expect($realisation->slug)->toBe('forage-de-puits-a-youbi');
    expect($realisation->facts)->toBe([
        ['icon' => 'hgi-location-01', 'text' => 'Youbi'],
        ['icon' => null, 'text' => 'Site unique'],
    ]);
    expect($realisation->tags)->toBe(['Mud logging', 'CTR']);
    Storage::disk('public')->assertExists($realisation->image);
});

test('an authenticated user can update a realisation', function () {
    $user = User::factory()->create();
    $realisation = Realisation::factory()->create(['title' => 'Ancien titre']);

    $response = $this->actingAs($user)->put("/admin/realisations/{$realisation->slug}", [
        'title' => 'Nouveau titre',
        'category' => $realisation->category,
        'description' => $realisation->description,
        'published_at' => $realisation->published_at->format('Y-m-d'),
    ]);

    $response->assertRedirect(route('admin.realisations.index'));
    expect($realisation->refresh()->title)->toBe('Nouveau titre');
});

test('an authenticated user can delete a realisation', function () {
    $user = User::factory()->create();
    $realisation = Realisation::factory()->create();

    $response = $this->actingAs($user)->delete("/admin/realisations/{$realisation->slug}");

    $response->assertRedirect(route('admin.realisations.index'));
    $this->assertModelMissing($realisation);
});

test('an editor can access realisations (content permissions are shared with admin)', function () {
    $editor = User::factory()->editor()->create();

    $response = $this->actingAs($editor)->get('/admin/realisations');

    $response->assertOk();
});
