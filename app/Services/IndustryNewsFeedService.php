<?php

namespace App\Services;

use Carbon\CarbonImmutable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Pulls a short "industry watch" of external headlines for the actualités page, from a
 * single credible public RSS feed. Never throws: a slow, unreachable or malformed feed
 * just yields an empty list, so the page renders normally either way.
 */
class IndustryNewsFeedService
{
    private const FEED_URL = 'https://oilprice.com/rss/main';

    private const CACHE_KEY = 'industry-news-feed';

    private const CACHE_TTL_MINUTES = 60;

    /**
     * @return Collection<int, array{title: string, url: string, source: string, published_at: ?CarbonImmutable}>
     */
    public function latest(int $limit = 6): Collection
    {
        return Cache::remember(
            self::CACHE_KEY,
            now()->addMinutes(self::CACHE_TTL_MINUTES),
            fn () => $this->fetch($limit),
        );
    }

    /**
     * @return Collection<int, array{title: string, url: string, source: string, published_at: ?CarbonImmutable}>
     */
    private function fetch(int $limit): Collection
    {
        try {
            $response = Http::connectTimeout(3)->timeout(5)->get(self::FEED_URL);
        } catch (ConnectionException $e) {
            Log::warning('Industry news feed unreachable.', ['exception' => $e->getMessage()]);

            return collect();
        }

        if (! $response->successful()) {
            Log::warning('Industry news feed returned an error response.', ['status' => $response->status()]);

            return collect();
        }

        $xml = simplexml_load_string($response->body());

        if ($xml === false || ! isset($xml->channel->item)) {
            Log::warning('Industry news feed returned unparsable XML.');

            return collect();
        }

        // collect($xml->channel->item) silently keeps only the last <item>: SimpleXMLElement's
        // array conversion collapses repeated sibling nodes onto a single key. Iterate explicitly.
        $items = [];
        foreach ($xml->channel->item as $item) {
            $items[] = $item;
        }

        return collect($items)
            ->take($limit)
            ->map(fn ($item) => [
                'title' => trim((string) $item->title),
                'url' => trim((string) $item->link),
                'source' => 'OilPrice.com',
                'published_at' => $this->parseDate((string) $item->pubDate),
            ])
            ->filter(fn (array $item) => $item['title'] !== '' && $item['url'] !== '')
            ->values();
    }

    private function parseDate(string $value): ?CarbonImmutable
    {
        try {
            return CarbonImmutable::parse($value);
        } catch (Throwable) {
            return null;
        }
    }
}
