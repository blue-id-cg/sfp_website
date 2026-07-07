@extends('layouts.app', [
    'title' => 'Carrières · SFP · Société de Forages Pétroliers',
    'description' => "Rejoignez la Société de Forages Pétroliers (SFP). Découvrez nos offres d'emploi, notre environnement de travail et déposez votre candidature.",
])

@section('content')
    @include('partials.page-head', [
        'image' => 'crew-walking',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Carrières', 'url' => null],
        ],
        'kicker' => 'Carrières',
        'kickerIndex' => 'RH',
        'title' => 'Construisez votre avenir avec la SFP',
        'lead' => "Rejoignez une équipe d'excellence au service de l'énergie congolaise. Nous recherchons des talents passionnés, rigoureux et engagés dans des métiers exigeants et porteurs de sens.",
    ])

    <!-- Pourquoi nous rejoindre -->
    <section class="section">
        <div class="wrap">
            <div class="split items-center">
                <div class="reveal-left">
                    <div class="frame wide">
                        <div class="media hover">
                            <picture>
                                <source type="image/webp" srcset="{{ asset('images/opt/crew-women.webp') }}" />
                                <img src="{{ asset('images/opt/crew-women.jpg') }}" alt="Collaboratrices de la SFP sur un site de forage" loading="lazy" width="1650" height="2200" />
                            </picture>
                        </div>
                        <div class="plate"><b>Talents</b><span>Au cœur du métier</span></div>
                    </div>
                </div>
                <div class="reveal-right">
                    <span class="kicker" data-index="01">Pourquoi nous rejoindre</span>
                    <h2 class="title-xl">Grandir dans un métier <span class="mark accent">d'exigence</span></h2>
                    <p class="lead mt-3">Le forage pétrolier exige compétence, rigueur et esprit d'équipe. À la SFP, vous évoluez au contact d'opérations complexes, aux côtés de professionnels expérimentés, dans un environnement où la sécurité et la transmission du savoir-faire sont essentielles.</p>
                    <p class="mt-2 text-body">Nous investissons dans la formation, le développement des compétences et l'évolution professionnelle de chacun. Ici, l'engagement et les talents sont reconnus et valorisés.</p>
                    <a href="#offres" class="btn btn-dark mt-4">Voir les offres <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Avantages / environnement de travail -->
    <section class="section bg-industrial">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker" data-index="02">Environnement de travail</span>
                <h2 class="title-xl">Ce que nous offrons</h2>
            </div>
            <div class="perks stagger">
                <div class="perk"><i class="fas fa-graduation-cap"></i><h4>Formation &amp; évolution</h4><p>Développement continu des compétences et parcours d'évolution professionnelle.</p></div>
                <div class="perk"><i class="fas fa-helmet-safety"></i><h4>Sécurité &amp; bien-être</h4><p>Une culture HSE forte et des conditions de travail encadrées sur chaque site.</p></div>
                <div class="perk"><i class="fas fa-oil-well"></i><h4>Projets d'envergure</h4><p>Des opérations techniques stimulantes au cœur du secteur pétrolier.</p></div>
                <div class="perk"><i class="fas fa-people-group"></i><h4>Esprit d'équipe</h4><p>Un collectif soudé où la transmission du savoir-faire est une valeur.</p></div>
                <div class="perk"><i class="fas fa-hand-holding-heart"></i><h4>Reconnaissance</h4><p>Valorisation de l'engagement, des compétences et de la fidélité de chaque collaborateur.</p></div>
                <div class="perk"><i class="fas fa-earth-africa"></i><h4>Impact &amp; fierté</h4><p>Contribuer au développement énergétique du Congo, avec sens et responsabilité.</p></div>
            </div>
        </div>
    </section>

    <!-- Offres d'emploi -->
    <section id="offres" class="section">
        <div class="wrap">
            <div class="sec-head-split mb-4">
                <div class="reveal">
                    <span class="kicker" data-index="03">Opportunités</span>
                    <h2 class="title-xl">Nos offres d'emploi</h2>
                </div>
                <div class="r reveal">
                    <p class="lead"><strong>{{ count($offres) }}</strong> poste(s) actuellement ouvert(s). Vous ne trouvez pas votre profil ? Adressez-nous une candidature spontanée ci-dessous.</p>
                </div>
            </div>

            @if (count($offres))
                <div class="jobs reveal">
                    @foreach ($offres as $offre)
                        <article class="job">
                            <div class="job-main">
                                <h3>{{ $offre['title'] }}</h3>
                                <div class="job-tags">
                                    @foreach ($offre['tags'] as $tag)
                                        <span class="job-tag"><i class="fas fa-tag"></i> {{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="job-cta">
                                <a href="{{ route('offres.show', $offre['slug']) }}" class="btn btn-ghost btn-sm">Voir l'offre <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="ico"><i class="fas fa-briefcase"></i></div>
                    <h3>Aucune offre ouverte pour le moment</h3>
                    <p>N'hésitez pas à nous adresser une candidature spontanée, notre équipe RH étudie chaque profil avec attention.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Candidature -->
    <section id="candidature" class="section bg-charcoal noise section-photo">
        <div class="wrap">
            <div class="split items-start">
                <div class="reveal-left">
                    <span class="kicker on-dark" data-index="04">Candidature</span>
                    <h2 class="title-xl on-dark">Déposez votre candidature</h2>
                    <p class="lead mt-3">Candidature spontanée ou réponse à une offre : transmettez-nous votre dossier. Chaque profil est étudié avec attention par notre équipe RH.</p>
                    <ul class="feature-list">
                        <li><span class="ico"><i class="fas fa-file-lines"></i></span><div><h4>CV &amp; lettre de motivation</h4><p>Formats PDF ou Word acceptés.</p></div></li>
                        <li><span class="ico"><i class="fas fa-lock"></i></span><div><h4>Confidentialité</h4><p>Vos données sont utilisées uniquement pour le traitement de votre candidature.</p></div></li>
                    </ul>
                </div>

                <div class="reveal-right">
                    @include('partials.application-form')
                </div>
            </div>
        </div>
    </section>
@endsection
