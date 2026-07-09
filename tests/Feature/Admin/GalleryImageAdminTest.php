<?php

use App\Models\GalleryImage;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guests cannot access the admin gallery', function () {
    $response = $this->get('/admin/gallery');

    $response->assertRedirect('/login');
});

test('an authenticated user can upload a gallery image', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/gallery', [
        'title' => 'Nouvelle photo',
        'caption' => 'Une légende',
        'image' => UploadedFile::fake()->image('photo.jpg'),
    ]);

    $response->assertRedirect(route('admin.gallery.index'));

    $image = GalleryImage::query()->where('title', 'Nouvelle photo')->first();
    expect($image)->not->toBeNull();
    Storage::disk('public')->assertExists($image->image);
});

test('uploading a gallery image requires a file', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/admin/gallery', []);

    $response->assertSessionHasErrors(['image']);
});

test('an authenticated user can delete a gallery image and its file', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $path = UploadedFile::fake()->image('photo.jpg')->store('gallery', 'public');
    $image = GalleryImage::factory()->create(['image' => $path]);

    $response = $this->actingAs($user)->delete("/admin/gallery/{$image->id}");

    $response->assertRedirect(route('admin.gallery.index'));
    $this->assertModelMissing($image);
    Storage::disk('public')->assertMissing($path);
});
