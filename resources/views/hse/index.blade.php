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
        'kicker' => 'Santé · Sécurité · Environnement',
        'title' => 'La sécurité avant la performance',
        'lead' => 'Notre engagement pour la santé, la sécurité et l\'environnement est non négociable. C\'est le fondement de notre culture d\'entreprise et la condition de chaque opération.',
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
                <span class="kicker on-dark" data-index="01">Nos engagements</span>
                <h2 class="title-xl on-dark">Une culture HSE au quotidien</h2>
            </div>
            <div class="hse-metrics stagger" role="list">
                <div role="listitem"><i class="hgi-stroke hgi-vest"></i><b>EPI</b><span>Obligatoires sur l'ensemble des sites d'intervention</span></div>
                <div role="listitem"><i class="hgi-stroke hgi-user-group"></i><b>Briefing</b><span>Point sécurité systématique avant chaque opération</span></div>
                <div role="listitem"><i class="hgi-stroke hgi-clipboard"></i><b>Audits</b><span>Contrôles et bonnes pratiques régulièrement vérifiés</span></div>
                <div role="listitem"><i class="hgi-stroke hgi-shield-01"></i><b>Zéro</b><span>Objectif zéro incident, non négociable</span></div>
            </div>
        </div>
    </section>

    <section class="section bg-industrial">
        <div class="wrap">
            <div class="split items-center">
                <div class="reveal-left">
                    <span class="kicker" data-index="02">Notre méthode</span>
                    <h2 class="title-xl">Une démarche <span class="mark accent">structurée</span>, du bureau au terrain</h2>
                    <p class="lead mt-3">La prévention se construit avant l'arrivée sur site : analyse des risques, plans d'action et procédures validées en amont, puis appliquées avec rigueur sur chaque chantier.</p>
                    <ul class="feature-list">
                        <li><span class="ico"><i class="hgi-stroke hgi-search-01"></i></span><div><h4>Analyse des risques</h4><p>Identification et traitement des dangers avant chaque opération.</p></div></li>
                        <li><span class="ico"><i class="hgi-stroke hgi-graduation-scroll"></i></span><div><h4>Formation continue</h4><p>Sensibilisation régulière des équipes aux bonnes pratiques HSE.</p></div></li>
                        <li><span class="ico"><i class="hgi-stroke hgi-leaf-01"></i></span><div><h4>Impact environnemental</h4><p>Gestion responsable des déchets et des ressources sur chaque site.</p></div></li>
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
