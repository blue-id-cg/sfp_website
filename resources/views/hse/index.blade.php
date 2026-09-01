@extends('layouts.app', [
    'title' => 'Santé, Sécurité, Environnement · SFP · Société de Forages Pétroliers',
    'description' => "L'engagement HSE de la SFP : maîtrise des risques, protection des équipes et respect de l'environnement sur chaque site de forage.",
])

@section('content')
    @include('partials.page-head', [
        'image' => 'crew-platform',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'HSE', 'url' => null],
        ],
        'kicker' => $page->get('intro.kicker', 'Santé · Sécurité · Environnement'),
        'title' => $page->get('intro.title', 'La sécurité avant la performance'),
        'lead' => $page->get('intro.lead', 'Notre engagement pour la santé, la sécurité et l\'environnement est non négociable. C\'est le fondement de notre culture d\'entreprise et la condition de chaque opération.'),
    ])

    <section class="section">
        <div class="wrap">
            <div class="hse-grid stagger">
                <article class="hse-card">
                    <picture>
                        <source type="image/webp" srcset="{{ asset('images/opt/crew-platform.webp') }}" />
                        <img src="{{ asset('images/opt/crew-platform.jpg') }}" alt="Équipes SFP équipées d'EPI lors d'un briefing sécurité sur la plateforme" loading="lazy" />
                    </picture>
                    <div class="body">
                        <span class="pill pill-y">Prévention</span>
                        <h3>Maîtrise des risques</h3>
                        <p>Analyse des risques avant chaque opération, procédures rigoureuses et vigilance permanente sur site.</p>
                    </div>
                </article>
                <article class="hse-card">
                    <picture>
                        <source type="image/webp" srcset="{{ asset('images/opt/crew-mudpumps.webp') }}" />
                        <img src="{{ asset('images/opt/crew-mudpumps.jpg') }}" alt="Encadrement et sensibilisation des équipes techniques sur un chantier de forage" loading="lazy" />
                    </picture>
                    <div class="body">
                        <span class="pill pill-y">Protection</span>
                        <h3>Protection des personnes</h3>
                        <p>Équipements de protection individuelle, formation continue et culture safety partagée par tous.</p>
                    </div>
                </article>
                <article class="hse-card">
                    <picture>
                        <source type="image/webp" srcset="{{ asset('images/opt/crew-walking.webp') }}" />
                        <img src="{{ asset('images/opt/crew-walking.jpg') }}" alt="Collaborateurs SFP en tenue de sécurité sur un site industriel" loading="lazy" />
                    </picture>
                    <div class="body">
                        <span class="pill pill-y">Environnement</span>
                        <h3>Respect de l'environnement</h3>
                        <p>Gestion durable des déchets, réduction des impacts et protection des écosystèmes autour des sites.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section-tight bg-charcoal noise">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker on-dark" data-index="01">{{ $page->get('engagements.kicker', 'Nos engagements') }}</span>
                <h2 class="title-xl on-dark">{{ $page->get('engagements.title', 'Une culture HSE au quotidien') }}</h2>
            </div>
            <div class="hse-metrics stagger" role="list">
                @foreach ($engagements as $metric)
                    <div role="listitem"><i class="hgi-stroke {{ $metric->icon }}"></i><b>{{ $metric->title }}</b><span>{{ $metric->description }}</span></div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section bg-industrial">
        <div class="wrap">
            <div class="split items-center">
                <div class="reveal-left">
                    <span class="kicker" data-index="02">{{ $page->get('method.kicker', 'Notre méthode') }}</span>
                    <h2 class="title-xl">{{ $page->get('method.title', 'Une démarche structurée, du bureau au terrain') }}</h2>
                    <p class="lead mt-3">{{ $page->get('method.lead', 'La prévention se construit avant l\'arrivée sur site : analyse des risques, plans d\'action et procédures validées en amont, puis appliquées avec rigueur sur chaque chantier.') }}</p>
                    <ul class="feature-list">
                        @foreach ($methodItems as $item)
                            <li><span class="ico"><i class="hgi-stroke {{ $item->icon }}"></i></span><div><h4>{{ $item->title }}</h4><p>{{ $item->description }}</p></div></li>
                        @endforeach
                    </ul>
                </div>
                <div class="reveal-right">
                    <div class="frame">
                        <div class="media hover">
                            <picture>
                                <source type="image/webp" srcset="{{ asset('images/opt/crew-mudpumps-m.webp') }}" />
                                <img src="{{ asset('images/opt/crew-mudpumps-m.jpg') }}" alt="Équipe SFP en briefing sécurité avant une opération de forage" loading="lazy" />
                            </picture>
                        </div>
                        <span class="pill pill-y tag-corner">Zéro incident</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
