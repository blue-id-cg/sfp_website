<?php

use App\Models\ContactMessage;
use App\Models\User;

test('guests cannot access admin contact messages', function () {
    $response = $this->get('/admin/messages');

    $response->assertRedirect('/login');
});

test('viewing a message marks it as read', function () {
    $user = User::factory()->create();
    $message = ContactMessage::factory()->create(['read_at' => null]);

    $response = $this->actingAs($user)->get(route('admin.messages.show', $message));

    $response->assertOk();
    expect($message->refresh()->read_at)->not->toBeNull();
});

test('the messages list can be filtered by status and search term', function () {
    $user = User::factory()->create();
    ContactMessage::factory()->create(['name' => 'Jean Moukala', 'read_at' => null]);
    ContactMessage::factory()->create(['name' => 'Alice Kimbembe', 'read_at' => now()]);

    $response = $this->actingAs($user)->get('/admin/messages?status=unread');
    $response->assertOk();
    $response->assertSee('Jean Moukala');
    $response->assertDontSee('Alice Kimbembe');

    $response = $this->actingAs($user)->get('/admin/messages?q=Kimbembe');
    $response->assertOk();
    $response->assertSee('Alice Kimbembe');
    $response->assertDontSee('Jean Moukala');
});

test('an authenticated user can delete a message', function () {
    $user = User::factory()->create();
    $message = ContactMessage::factory()->create();

    $response = $this->actingAs($user)->delete(route('admin.messages.destroy', $message));

    $response->assertRedirect(route('admin.messages.index'));
    $this->assertModelMissing($message);
});
