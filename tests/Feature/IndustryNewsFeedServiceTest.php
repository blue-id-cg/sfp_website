<?php

use App\Services\IndustryNewsFeedService;
use Illuminate\Support\Facades\Http;

function fakeRssFeed(string $title, array $items): string
{
    $xmlItems = collect($items)->map(fn (array $item) => sprintf(
        '<item><title>%s</title><link>%s</link><pubDate>%s</pubDate></item>',
        $item['title'],
        $item['link'],
        $item['pubDate'],
    ))->implode('');

    return '<?xml version="1.0" encoding="UTF-8"?>'
        ."<rss version=\"2.0\"><channel><title>{$title}</title>{$xmlItems}</channel></rss>";
}

test('it merges and sorts headlines from every configured feed', function () {
    Http::preventStrayRequests();
    Http::fake([
        'oilprice.com/rss/main' => Http::response(fakeRssFeed('Oilprice.com', [
            ['title' => 'Oil Headline', 'link' => 'https://oilprice.com/one', 'pubDate' => 'Wed, 23 Sep 2026 07:00:00 -0500'],
        ]), 200, ['Content-Type' => 'application/rss+xml']),
        'naturalgasintel.com/feed/' => Http::response(fakeRssFeed('Natural Gas Intelligence', [
            ['title' => 'Gas Headline', 'link' => 'https://naturalgasintel.com/one', 'pubDate' => 'Thu, 24 Sep 2026 09:00:00 -0500'],
        ]), 200, ['Content-Type' => 'application/rss+xml']),
        'offshore-technology.com/feed/' => Http::response(fakeRssFeed('Offshore Technology', [
            ['title' => 'Offshore Headline', 'link' => 'https://offshore-technology.com/one', 'pubDate' => 'Wed, 23 Sep 2026 12:00:00 -0500'],
        ]), 200, ['Content-Type' => 'application/rss+xml']),
        '*' => Http::response('<html></html>', 200),
    ]);

    $news = (new IndustryNewsFeedService)->latest();

    expect($news)->toHaveCount(3);
    // The Natural Gas Intelligence item is the most recent, so it sorts first.
    expect($news->first()['title'])->toBe('Gas Headline');
    expect($news->pluck('source')->all())->toBe(['Natural Gas Intelligence', 'Offshore Technology', 'OilPrice.com']);
});

test('a feed that fails does not prevent the others from showing', function () {
    Http::preventStrayRequests();
    Http::fake([
        'oilprice.com/rss/main' => Http::failedConnection(),
        'naturalgasintel.com/feed/' => Http::response(fakeRssFeed('Natural Gas Intelligence', [
            ['title' => 'Gas Headline', 'link' => 'https://naturalgasintel.com/one', 'pubDate' => 'Thu, 24 Sep 2026 09:00:00 -0500'],
        ]), 200, ['Content-Type' => 'application/rss+xml']),
        'offshore-technology.com/feed/' => Http::response('Server error', 500),
        '*' => Http::response('<html></html>', 200),
    ]);

    $news = (new IndustryNewsFeedService)->latest();

    expect($news)->toHaveCount(1);
    expect($news->first()['source'])->toBe('Natural Gas Intelligence');
});

test('it enriches each headline with the thumbnail from its article page', function () {
    Http::preventStrayRequests();
    Http::fake([
        'oilprice.com/rss/main' => Http::response(fakeRssFeed('Oilprice.com', [
            ['title' => 'Oil Headline', 'link' => 'https://oilprice.com/one', 'pubDate' => 'Thu, 24 Sep 2026 07:00:00 -0500'],
        ]), 200, ['Content-Type' => 'application/rss+xml']),
        'naturalgasintel.com/feed/' => Http::response('<html></html>', 200),
        'offshore-technology.com/feed/' => Http::response('<html></html>', 200),
        'oilprice.com/one' => Http::response(
            '<html><head><meta property="og:image" content="https://cdn.oilprice.com/one.jpg" /></head></html>',
            200,
            ['Content-Type' => 'text/html'],
        ),
    ]);

    $news = (new IndustryNewsFeedService)->latest();

    expect($news->first()['image'])->toBe('https://cdn.oilprice.com/one.jpg');
});

test('a headline keeps a null image when its article page has none', function () {
    Http::preventStrayRequests();
    Http::fake([
        'oilprice.com/rss/main' => Http::response(fakeRssFeed('Oilprice.com', [
            ['title' => 'Oil Headline', 'link' => 'https://oilprice.com/one', 'pubDate' => 'Thu, 24 Sep 2026 07:00:00 -0500'],
        ]), 200, ['Content-Type' => 'application/rss+xml']),
        'naturalgasintel.com/feed/' => Http::response('<html></html>', 200),
        'offshore-technology.com/feed/' => Http::response('<html></html>', 200),
        'oilprice.com/one' => Http::response('<html></html>', 200),
    ]);

    $news = (new IndustryNewsFeedService)->latest();

    expect($news->first()['image'])->toBeNull();
});

test('it returns an empty collection when every feed is unreachable', function () {
    Http::preventStrayRequests();
    Http::fake(['*' => Http::failedConnection()]);

    $news = (new IndustryNewsFeedService)->latest();

    expect($news)->toBeEmpty();
});

test('the actualites page hides the industry watch section when every feed is unreachable', function () {
    Http::preventStrayRequests();
    Http::fake(['*' => Http::failedConnection()]);

    $response = $this->get('/actualites');

    $response->assertOk();
    $response->assertDontSee('Veille sectorielle');
});
