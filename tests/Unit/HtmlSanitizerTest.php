<?php

use App\Support\HtmlSanitizer;

test('it keeps allow-listed formatting tags', function () {
    $sanitizer = new HtmlSanitizer;

    $clean = $sanitizer->clean('<p>Bonjour <strong>monde</strong> et <em>bienvenue</em>.</p><h2>Titre</h2><ul><li>Un</li></ul>');

    expect($clean)->toBe('<p>Bonjour <strong>monde</strong> et <em>bienvenue</em>.</p><h2>Titre</h2><ul><li>Un</li></ul>');
});

test('it strips script tags and their content entirely', function () {
    $sanitizer = new HtmlSanitizer;

    $clean = $sanitizer->clean('<p>Salut</p><script>alert(1)</script>');

    expect($clean)->toBe('<p>Salut</p>');
});

test('it removes event handler attributes', function () {
    $sanitizer = new HtmlSanitizer;

    $clean = $sanitizer->clean('<p onclick="alert(1)">Salut</p>');

    expect($clean)->toBe('<p>Salut</p>');
});

test('it removes javascript: links but keeps the text', function () {
    $sanitizer = new HtmlSanitizer;

    $clean = $sanitizer->clean('<a href="javascript:alert(1)">lien</a>');

    expect($clean)->toBe('<a rel="noopener noreferrer" target="_blank">lien</a>');
});

test('it keeps safe links and adds rel and target', function () {
    $sanitizer = new HtmlSanitizer;

    $clean = $sanitizer->clean('<a href="https://example.com">lien</a>');

    expect($clean)->toBe('<a href="https://example.com" rel="noopener noreferrer" target="_blank">lien</a>');
});

test('it unwraps unknown tags but keeps their text content', function () {
    $sanitizer = new HtmlSanitizer;

    $clean = $sanitizer->clean('<div>Salut <span>tout le monde</span></div>');

    expect($clean)->toBe('Salut tout le monde');
});
