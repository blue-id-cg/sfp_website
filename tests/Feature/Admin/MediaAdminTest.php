<?php

use App\Models\Media;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guests cannot access the media library', function () {
    $response = $this->get('/admin/media');

    $response->assertRedirect('/login');
});

test('an authenticated user can list media', function () {
    $user = User::factory()->create();
    Media::factory()->count(3)->create();

    $response = $this->actingAs($user)->get('/admin/media');

    $response->assertOk();
});

test('an authenticated user can upload a media file', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/media', [
        'file' => UploadedFile::fake()->image('photo.jpg'),
        'alt_text' => 'Une photo',
    ]);

    $response->assertRedirect();

    $media = Media::query()->where('alt_text', 'Une photo')->first();
    expect($media)->not->toBeNull();
    Storage::disk('public')->assertExists($media->path);
});

test('an authenticated user can delete a media file', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $media = Media::factory()->create(['path' => 'media/to-delete.jpg']);
    Storage::disk('public')->put($media->path, 'fake-content');

    $response = $this->actingAs($user)->delete("/admin/media/{$media->id}");

    $response->assertRedirect(route('admin.media.index'));
    $this->assertModelMissing($media);
    Storage::disk('public')->assertMissing($media->path);
});

test('media uploads reject SVG files', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/media', [
        'file' => UploadedFile::fake()->create('icon.svg', 10, 'image/svg+xml'),
    ]);

    $response->assertSessionHasErrors(['file']);
});
