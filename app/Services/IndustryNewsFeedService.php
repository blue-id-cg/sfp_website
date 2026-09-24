<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Pulls a short "industry watch" of external headlines for the actualités page, merged
 * from a few credible public RSS feeds. Never throws: a slow, unreachable or malformed
 * feed just contributes nothing, so the page renders normally either way.
 */
class IndustryNewsFeedService
{
    /**
     * @var list<array{name: string, url: string}>
     */
    private const FEEDS = [
        ['name' => 'OilPrice.com', 'url' => 'https://oilprice.com/rss/main'],
        ['name' => 'Natural Gas Intelligence', 'url' => 'https://www.naturalgasintel.com/feed/'],
        ['name' => 'Offshore Technology', 'url' => 'https://www.offshore-technology.com/feed/'],
    ];

    private const CACHE_KEY = 'industry-news-feed';

    private const CACHE_TTL_MINUTES = 60;

    // Some publishers (e.g. Natural Gas Intelligence) return 403 to Guzzle's default
    // user agent as basic bot protection; a realistic browser UA gets a normal response.
    private const USER_AGENT = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36';

    /**
     * @return Collection<int, array{title: string, url: string, source: string, published_at: ?CarbonImmutable, image: ?string}>
     */
    public function latest(int $limit = 6): Collection
    {
        try {
            $news = Cache::remember(
                self::CACHE_KEY,
                now()->addMinutes(self::CACHE_TTL_MINUTES),
                fn () => $this->fetch($limit),
            );
        } catch (Throwable $e) {
            Log::warning('Industry news feed cache entry was unreadable; refetching.', ['exception' => $e->getMessage()]);
            Cache::forget(self::CACHE_KEY);

            return $this->fetch($limit);
        }

        // A cache entry corrupted by a since-changed shape (e.g. an object that no longer
        // unserializes cleanly) can come back as something other than a Collection without
        // throwing. Guard the declared return type the same way as the throwing case above.
        if (! $news instanceof Collection) {
            Cache::forget(self::CACHE_KEY);

            return $this->fetch($limit);
        }

        return $news;
    }

    /**
     * @return Collection<int, array{title: string, url: string, source: string, published_at: ?CarbonImmutable, image: ?string}>
     */
    private function fetch(int $limit): Collection
    {
        $news = $this->fetchFeeds()
            ->sortByDesc(fn (array $item) => $item['published_at']?->timestamp ?? 0)
            ->take($limit)
            ->values();

        return $this->withThumbnails($news);
    }

    /**
     * Fetch every configured feed concurrently — one round trip for all sources, not
     * one after another — and merge whatever comes back. A feed that fails, times out,
     * or returns unparsable XML just contributes no items; the others still show.
     *
     * @return Collection<int, array{title: string, url: string, source: string, published_at: ?CarbonImmutable, image: ?string}>
     */
    private function fetchFeeds(): Collection
    {
        try {
            $responses = Http::pool(fn (Pool $pool) => collect(self::FEEDS)
                ->map(fn (array $feed, int $index) => $pool->as($index)
                    ->connectTimeout(3)
                    ->timeout(5)
                    ->withOptions($this->httpOptions())
                    ->withUserAgent(self::USER_AGENT)
                    ->get($feed['url']))
                ->all());
        } catch (Throwable $e) {
            Log::warning('Industry news feeds could not be fetched.', ['exception' => $e->getMessage()]);

            return collect();
        }

        return collect(self::FEEDS)
            ->flatMap(function (array $feed, int $index) use ($responses) {
                $response = $responses[$index] ?? null;

                if (! $response instanceof Response || ! $response->successful()) {
                    Log::warning("Industry news feed \"{$feed['name']}\" is unavailable.");

                    return [];
                }

                return $this->parseFeed($response->body(), $feed['name']);
            });
    }

    /**
     * @return list<array{title: string, url: string, source: string, published_at: ?CarbonImmutable, image: ?string}>
     */
    private function parseFeed(string $body, string $sourceName): array
    {
        $previousSetting = libxml_use_internal_errors(true);
        $xml = simplexml_load_string($body);
        libxml_clear_errors();
        libxml_use_internal_errors($previousSetting);

        if ($xml === false || ! isset($xml->channel->item)) {
            Log::warning("Industry news feed \"{$sourceName}\" returned unparsable XML.");

            return [];
        }

        // collect($xml->channel->item) silently keeps only the last <item>: SimpleXMLElement's
        // array conversion collapses repeated sibling nodes onto a single key. Iterate explicitly.
        $items = [];
        foreach ($xml->channel->item as $item) {
            $items[] = $item;
        }

        return collect($items)
            ->map(fn ($item) => [
                'title' => trim((string) $item->title),
                'url' => trim((string) $item->link),
                'source' => $sourceName,
                'published_at' => $this->parseDate((string) $item->pubDate),
                'image' => null,
            ])
            ->filter(fn (array $item) => $item['title'] !== '' && $item['url'] !== '')
            ->values()
            ->all();
    }

    /**
     * The RSS feeds themselves carry no image. Each article's own page does, as an
     * `og:image` meta tag, so fetch every article page concurrently — one round trip
     * for the whole batch, not one per item — and fill in what succeeds. An article
     * page that fails, times out, or has no og:image just keeps a null image.
     *
     * @param  Collection<int, array{title: string, url: string, source: string, published_at: ?CarbonImmutable, image: ?string}>  $news
     * @return Collection<int, array{title: string, url: string, source: string, published_at: ?CarbonImmutable, image: ?string}>
     */
    private function withThumbnails(Collection $news): Collection
    {
        if ($news->isEmpty()) {
            return $news;
        }

        try {
            $responses = Http::pool(fn (Pool $pool) => $news
                ->map(fn (array $item, int $index) => $pool->as($index)
                    ->connectTimeout(2)
                    ->timeout(4)
                    ->withOptions($this->httpOptions())
                    ->withUserAgent(self::USER_AGENT)
                    ->get($item['url']))
                ->all());
        } catch (Throwable $e) {
            Log::warning('Industry news thumbnails could not be fetched.', ['exception' => $e->getMessage()]);

            return $news;
        }

        return $news->map(function (array $item, int $index) use ($responses) {
            $response = $responses[$index] ?? null;

            if ($response instanceof Response && $response->successful()) {
                $item['image'] = $this->extractOgImage($response->body());
            }

            return $item;
        })->values();
    }

    private function extractOgImage(string $html): ?string
    {
        if (! preg_match('/<meta\s+property=["\']og:image["\']\s+content=["\']([^"\']+)["\']/i', $html, $matches)) {
            return null;
        }

        $url = trim($matches[1]);

        return filter_var($url, FILTER_VALIDATE_URL) ? $url : null;
    }

    private function parseDate(string $value): ?CarbonImmutable
    {
        try {
            return CarbonImmutable::parse($value);
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * On some local Windows setups, PHP's cURL/OpenSSL has no CA bundle configured
     * (curl.cainfo / openssl.cafile unset), so every HTTPS request fails with
     * "unable to get local issuer certificate" even though the OS trusts the cert.
     * Point Guzzle at a bundled CA file when one ships with the app; environments
     * with a working system CA store are unaffected since this is additive.
     *
     * @return array<string, mixed>
     */
    private function httpOptions(): array
    {
        $bundle = storage_path('certs/cacert.pem');

        return is_file($bundle) ? ['verify' => $bundle] : [];
    }
}
