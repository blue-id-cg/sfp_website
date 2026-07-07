<?php

namespace App\Http\Controllers;

use App\Support\Content\Actualites;
use App\Support\Content\Offres;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Disallow:',
            '',
            'Sitemap: '.route('sitemap'),
        ];

        return response(implode("\n", $lines), 200, ['Content-Type' => 'text/plain']);
    }

    public function sitemap(): Response
    {
        $urls = [
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('actualites.index'), 'priority' => '0.8'],
            ['loc' => route('carrieres.index'), 'priority' => '0.8'],
        ];

        foreach (Actualites::all() as $actualite) {
            $urls[] = ['loc' => route('actualites.show', $actualite['slug']), 'priority' => '0.6'];
        }

        foreach (Offres::all() as $offre) {
            $urls[] = ['loc' => route('offres.show', $offre['slug']), 'priority' => '0.6'];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
