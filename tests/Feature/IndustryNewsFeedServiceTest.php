<?php

use App\Services\IndustryNewsFeedService;
use Illuminate\Support\Facades\Http;

test('it parses headlines from the RSS feed', function () {
    Http::preventStrayRequests();
    $xml = '<?xml version="1.0" encoding="UTF-8"?>'
        .'<rss version="2.0"><channel><title>Oilprice.com</title>'
        .'<item><title>Test Headline One</title><link>https://oilprice.com/one</link><pubDate>Thu, 24 Sep 2026 07:00:00 -0500</pubDate></item>'
        .'<item><title>Test Headline Two</title><link>https://oilprice.com/two</link><pubDate>Wed, 23 Sep 2026 07:00:00 -0500</pubDate></item>'
        .'</channel></rss>';
    Http::fake([
        'oilprice.com/*' => Http::response($xml, 200, ['Content-Type' => 'application/rss+xml']),
    ]);

    $news = (new IndustryNewsFeedService)->latest();

    expect($news)->toHaveCount(2);
    expect($news->first()['title'])->toBe('Test Headline One');
    expect($news->first()['url'])->toBe('https://oilprice.com/one');
    expect($news->first()['source'])->toBe('OilPrice.com');
});

test('it returns an empty collection when the feed is unreachable', function () {
    Http::preventStrayRequests();
    Http::fake([
        'oilprice.com/*' => Http::failedConnection(),
    ]);

    $news = (new IndustryNewsFeedService)->latest();

    expect($news)->toBeEmpty();
});

test('it returns an empty collection when the feed responds with an error', function () {
    Http::preventStrayRequests();
    Http::fake([
        'oilprice.com/*' => Http::response('Server error', 500),
    ]);

    $news = (new IndustryNewsFeedService)->latest();

    expect($news)->toBeEmpty();
});

test('the actualites page hides the industry watch section when the feed is empty', function () {
    Http::preventStrayRequests();
    Http::fake(['oilprice.com/*' => Http::failedConnection()]);

    $response = $this->get('/actualites');

    $response->assertOk();
    $response->assertDontSee('Veille sectorielle');
});
