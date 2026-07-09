<?php

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

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

test('the contact form requires a name, email and message', function () {
    $response = $this->post('/contact', []);

    $response->assertSessionHasErrors(['name', 'email', 'message']);
    expect(ContactMessage::query()->count())->toBe(0);
});
