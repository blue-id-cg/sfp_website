<?php

use App\Models\Actualite;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guests cannot access the admin actualites list', function () {
    $response = $this->get('/admin/actualites');

    $response->assertRedirect('/login');
});

test('an authenticated user can list actualites', function () {
    $user = User::factory()->create();
    Actualite::factory()->count(3)->create();

    $response = $this->actingAs($user)->get('/admin/actualites');

    $response->assertOk();
});

test('the actualites list can be filtered by title', function () {
    $user = User::factory()->create();
    Actualite::factory()->create(['title' => 'Forage de puits à Kundji']);
    Actualite::factory()->create(['title' => 'Nouveau partenariat régional']);

    $response = $this->actingAs($user)->get('/admin/actualites?q=Kundji');

    $response->assertOk();
    $response->assertSee('Forage de puits à Kundji');
    $response->assertDontSee('Nouveau partenariat régional');
});

test('an authenticated user can create an actualite with an image', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/actualites', [
        'title' => 'Nouvelle actualité',
        'category' => 'Innovation',
        'excerpt' => 'Un résumé',
        'body' => 'Le contenu en *markdown*.',
        'image' => UploadedFile::fake()->image('photo.jpg'),
        'published_at' => now()->format('Y-m-d'),
    ]);

    $response->assertRedirect(route('admin.actualites.index'));

    $actualite = Actualite::query()->where('title', 'Nouvelle actualité')->first();
    expect($actualite)->not->toBeNull();
    expect($actualite->slug)->toBe('nouvelle-actualite');
    Storage::disk('public')->assertExists($actualite->image);
});

test('creating an actualite requires a title and body', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/actualites', []);

    $response->assertSessionHasErrors(['title', 'body']);
});

test('an authenticated user can update an actualite', function () {
    $user = User::factory()->create();
    $actualite = Actualite::factory()->create(['title' => 'Ancien titre']);

    $response = $this->actingAs($user)->put("/admin/actualites/{$actualite->slug}", [
        'title' => 'Titre modifié',
        'category' => $actualite->category,
        'excerpt' => $actualite->excerpt,
        'body' => $actualite->body,
        'published_at' => $actualite->published_at->format('Y-m-d'),
    ]);

    $response->assertRedirect(route('admin.actualites.index'));
    expect($actualite->refresh()->title)->toBe('Titre modifié');
});

test('an authenticated user can delete an actualite', function () {
    $user = User::factory()->create();
    $actualite = Actualite::factory()->create();

    $response = $this->actingAs($user)->delete("/admin/actualites/{$actualite->slug}");

    $response->assertRedirect(route('admin.actualites.index'));
    $this->assertModelMissing($actualite);
});
