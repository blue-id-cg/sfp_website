<?php

use App\Models\Offre;
use Illuminate\Support\Facades\Mail;

test('the careers page only lists published offres', function () {
    $published = Offre::factory()->create(['title' => 'Poste ouvert']);
    $draft = Offre::factory()->draft()->create(['title' => 'Poste brouillon']);

    $response = $this->get('/carrieres');

    $response->assertOk();
    $response->assertSee($published->title);
    $response->assertDontSee($draft->title);
});

test('a published offre can be viewed', function () {
    $offre = Offre::factory()->create();

    $response = $this->get(route('offres.show', $offre));

    $response->assertOk();
    $response->assertSee($offre->title);
});

test('a draft offre returns 404 on the public site', function () {
    $offre = Offre::factory()->draft()->create();

    $response = $this->get(route('offres.show', $offre));

    $response->assertNotFound();
});

test('applying from an offre page redirects back to that same page', function () {
    Mail::fake();

    $offre = Offre::factory()->create();

    $response = $this
        ->from(route('offres.show', $offre))
        ->post('/contact', [
            'name' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'subject' => 'Candidature — '.$offre->title,
            'message' => 'Je souhaite postuler à ce poste.',
        ]);

    $response->assertRedirect(route('offres.show', $offre));
    $response->assertSessionHas('contact_sent', true);
});
