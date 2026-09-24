<?php

use App\Models\Equipment;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guests cannot access the admin equipment list', function () {
    $response = $this->get('/admin/equipment');

    $response->assertRedirect('/login');
});

test('an authenticated user can list equipment', function () {
    $user = User::factory()->create();
    Equipment::factory()->count(3)->create();

    $response = $this->actingAs($user)->get('/admin/equipment');

    $response->assertOk();
});

test('an authenticated user can create equipment with an image, a spec sheet and trades', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $trade = Trade::factory()->create();

    $response = $this->actingAs($user)->post('/admin/equipment', [
        'title' => 'Nouvel équipement',
        'description' => 'Un résumé',
        'body' => '<p>Le détail.</p>',
        'image' => UploadedFile::fake()->image('photo.jpg'),
        'spec_sheet' => UploadedFile::fake()->create('fiche.pdf', 100, 'application/pdf'),
        'trades' => [$trade->id],
    ]);

    $response->assertRedirect(route('admin.equipment.index'));

    $equipment = Equipment::query()->where('title', 'Nouvel équipement')->first();
    expect($equipment)->not->toBeNull();
    expect($equipment->slug)->toBe('nouvel-equipement');
    expect($equipment->trades->pluck('id')->all())->toBe([$trade->id]);
    Storage::disk('public')->assertExists($equipment->image);
    Storage::disk('public')->assertExists($equipment->spec_sheet);
});

test('creating equipment requires a title', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/equipment', []);

    $response->assertSessionHasErrors(['title']);
});

test('an authenticated user can update equipment', function () {
    $user = User::factory()->create();
    $equipment = Equipment::factory()->create(['title' => 'Ancien titre']);

    $response = $this->actingAs($user)->put("/admin/equipment/{$equipment->slug}", [
        'title' => 'Titre modifié',
        'description' => $equipment->description,
        'body' => $equipment->body,
    ]);

    $response->assertRedirect(route('admin.equipment.index'));
    expect($equipment->refresh()->title)->toBe('Titre modifié');
});

test('an authenticated user can delete equipment', function () {
    $user = User::factory()->create();
    $equipment = Equipment::factory()->create();

    $response = $this->actingAs($user)->delete("/admin/equipment/{$equipment->slug}");

    $response->assertRedirect(route('admin.equipment.index'));
    $this->assertModelMissing($equipment);
});
