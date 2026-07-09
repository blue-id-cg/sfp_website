<?php

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

test('a visitor can submit the contact form', function () {
    Mail::fake();

    $response = $this->post('/contact', [
        'name' => 'Jean Dupont',
        'email' => 'jean@example.com',
        'phone' => '+242000000',
        'subject' => "Demande d'information",
        'message' => "Bonjour, je souhaite plus d'informations.",
    ]);

    $response->assertSessionHas('contact_sent', true);

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Jean Dupont',
        'email' => 'jean@example.com',
    ]);

    Mail::assertQueued(ContactMessageReceived::class);
});

test('a visitor can submit the contact form with a CV attached', function () {
    Storage::fake('public');
    Mail::fake();

    $response = $this->post('/contact', [
        'name' => 'Alice Kimbembe',
        'email' => 'alice@example.com',
        'subject' => 'Candidature — Ingénieur forage',
        'message' => 'Merci de considérer ma candidature.',
        'cv' => UploadedFile::fake()->create('cv-alice.pdf', 200, 'application/pdf'),
    ]);

    $response->assertSessionHas('contact_sent', true);

    $contactMessage = ContactMessage::query()->where('email', 'alice@example.com')->first();
    expect($contactMessage->cv_path)->not->toBeNull();
    Storage::disk('public')->assertExists($contactMessage->cv_path);

    Mail::assertQueued(ContactMessageReceived::class);
});

test('the contact form rejects a CV that is not a PDF or Word document', function () {
    Storage::fake('public');

    $response = $this->post('/contact', [
        'name' => 'Alice Kimbembe',
        'email' => 'alice@example.com',
        'message' => 'Merci de considérer ma candidature.',
        'cv' => UploadedFile::fake()->create('cv-alice.exe', 200, 'application/octet-stream'),
    ]);

    $response->assertSessionHasErrors(['cv']);
});

test('the contact form requires a name, email and message', function () {
    $response = $this->post('/contact', []);

    $response->assertSessionHasErrors(['name', 'email', 'message']);
    expect(ContactMessage::query()->count())->toBe(0);
});
