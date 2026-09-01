@extends('layouts.app', [
    'title' => 'Nos métiers · SFP · Société de Forages Pétroliers',
    'description' => "Forage, complétion, work over, mud logging, pompage et filtration : découvrez le cycle de vie du puits maîtrisé de bout en bout par la SFP.",
])

@section('content')
    @include('partials.page-head', [
        'image' => 'rig03-unit',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Métiers', 'url' => null],
        ],
        'kicker' => $page->get('intro.kicker', 'Nos métiers'),
        'title' => $page->get('intro.title', 'Le cycle de vie du puits, maîtrisé de bout en bout'),
        'lead' => $page->get('intro.lead', "De la préparation des opérations à la maintenance des installations, nos équipes couvrent l'ensemble des disciplines du forage pétrolier avec des équipements spécialisés."),
    ])

    <section class="section">
        <div class="wrap">
            <div class="trade-grid stagger">
                @foreach ($trades as $trade)
                    <article class="trade">
                        <div class="num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="ico"><i class="hgi-stroke {{ $trade->icon }}"></i></div>
                        <h3>{{ $trade->title }}</h3>
                        <p>{{ $trade->description }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section bg-industrial">
        <div class="wrap">
            <div class="split reverse items-center">
                <div class="reveal-right">
                    <span class="kicker" data-index="01">{{ $page->get('innovation.kicker', 'Innovation') }}</span>
                    <h2 class="title-xl">{{ $page->get('innovation.title', 'Performance opérationnelle & digitalisation') }}</h2>
                    <p class="lead mt-3">{{ $page->get('innovation.lead', "Nous intégrons les technologies les plus avancées pour optimiser chaque phase de nos opérations : de la surveillance en temps réel à l'analyse des données, jusqu'à la modernisation des équipements.") }}</p>

                    <ul class="feature-list">
                        @foreach ($instruments as $instrument)
                            <li><span class="ico"><i class="hgi-stroke {{ $instrument->icon }}"></i></span><div><h4>{{ $instrument->title }}</h4><p>{{ $instrument->description }}</p></div></li>
                        @endforeach
                    </ul>
                </div>

                <div class="reveal-left">
                    <div class="frame wide">
                        <div class="media hover">
                            <picture>
                                <source type="image/webp" srcset="{{ asset('images/opt/rig03-unit.webp') }}" />
                                <img src="{{ asset('images/opt/rig03-unit.jpg') }}" alt="Unité de forage mobile MR-3500 de la SFP sur un site pétrolier" loading="lazy" width="2000" height="934" />
                            </picture>
                        </div>
                        <div class="plate">
                            <b>MR&#8209;3500</b>
                            <span>Unité mobile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-tight bg-charcoal noise section-photo careers-cta">
        <div class="wrap">
            <div class="careers-cta-inner reveal">
                <div>
                    <span class="kicker on-dark" data-index="02">{{ $page->get('cta.kicker', 'Rejoignez-nous') }}</span>
                    <h2 class="title-xl on-dark">{{ $page->get('cta.title', 'Envie de mettre votre expertise au service du forage ?') }}</h2>
                    <p class="lead mt-2">{{ $page->get('cta.lead', "Découvrez nos offres d'emploi et rejoignez une équipe d'excellence au service de l'énergie congolaise.") }}</p>
                </div>
                <div class="careers-cta-actions">
                    <a href="{{ route('carrieres.index') }}" class="btn btn-primary">{{ $page->get('cta.button_label', "Voir les offres d'emploi") }} <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
