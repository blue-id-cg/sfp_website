@extends('layouts.app', [
    'title' => 'Politique de cookies · SFP · Société de Forages Pétroliers',
    'description' => "Les cookies utilisés sur le site de la Société de Forages Pétroliers (SFP) et comment les gérer.",
])

@section('content')
    @include('partials.page-head', [
        'image' => 'crew-walking',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Cookies', 'url' => null],
        ],
        'kicker' => 'Informations légales',
        'title' => 'Politique de cookies',
    ])

    <article class="section">
        <div class="wrap">
            <div class="article">
                <p class="lead">Un cookie est un petit fichier texte déposé sur votre appareil lors de la visite d'un site internet. Voici comment nous les utilisons.</p>

                <h2>Cookies strictement nécessaires</h2>
                <p>Notre site utilise uniquement des cookies techniques indispensables à son bon fonctionnement :</p>
                <ul class="dotted">
                    <li>Un cookie de session, permettant de maintenir votre navigation et la sécurité du site.</li>
                    <li>Un cookie de protection contre les attaques CSRF (falsification de requête), pour sécuriser les formulaires.</li>
                    <li>Un cookie technique mémorisant votre choix relatif au présent bandeau d'information sur les cookies.</li>
                </ul>
                <p>Ces cookies ne nécessitent pas de consentement préalable car ils sont indispensables à la fourniture du service demandé. Ils ne permettent aucun suivi publicitaire ni partage avec des tiers.</p>

                <h2>Cookies de mesure d'audience ou publicitaires</h2>
                <p>À ce jour, le site SFP n'utilise aucun cookie de mesure d'audience (analytics) ni cookie publicitaire ou de réseau social. Cette page sera mise à jour si cela venait à évoluer.</p>

                <h2>Gérer vos préférences</h2>
                <p>Vous pouvez à tout moment configurer votre navigateur pour refuser ou supprimer les cookies déposés. Le paramétrage est propre à chaque navigateur et accessible depuis son menu d'aide.</p>

                <h2>En savoir plus</h2>
                <p>Pour toute question relative aux cookies ou à la protection de vos données, consultez notre <a href="{{ route('legal.privacy') }}">politique de confidentialité</a> ou contactez-nous à <a href="mailto:contact@snpc-sfp.net">contact@snpc-sfp.net</a>.</p>
            </div>
        </div>
    </article>
@endsection
