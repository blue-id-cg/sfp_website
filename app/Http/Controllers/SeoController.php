<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Offre;
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
            ['loc' => route('about.index'), 'priority' => '0.7'],
            ['loc' => route('metiers.index'), 'priority' => '0.7'],
            ['loc' => route('hse.index'), 'priority' => '0.7'],
            ['loc' => route('equipements.index'), 'priority' => '0.7'],
            ['loc' => route('actualites.index'), 'priority' => '0.8'],
            ['loc' => route('carrieres.index'), 'priority' => '0.8'],
            ['loc' => route('galerie.index'), 'priority' => '0.5'],
            ['loc' => route('legal.mentions'), 'priority' => '0.2'],
            ['loc' => route('legal.privacy'), 'priority' => '0.2'],
            ['loc' => route('legal.cookies'), 'priority' => '0.2'],
        ];

        foreach (Actualite::query()->published()->get() as $actualite) {
            $urls[] = ['loc' => route('actualites.show', $actualite), 'priority' => '0.6'];
        }

        foreach (Offre::query()->published()->get() as $offre) {
            $urls[] = ['loc' => route('offres.show', $offre), 'priority' => '0.6'];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
