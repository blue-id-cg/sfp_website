@extends('layouts.app', [
    'title' => "À propos · SFP · Société de Forages Pétroliers",
    'description' => "Découvrez l'histoire, les valeurs et l'expertise de la Société de Forages Pétroliers (SFP), filiale du groupe SNPC au Congo.",
])

@section('content')
    @include('partials.page-head', [
        'image' => 'leadership',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'À propos', 'url' => null],
        ],
        'kicker' => $page->get('intro.kicker', "L'entreprise"),
        'title' => $page->get('intro.title', 'À propos de la SFP'),
        'lead' => $page->get('intro.lead', "L'expertise congolaise du forage pétrolier, au service des grands opérateurs du secteur."),
    ])

    <!-- Histoire -->
    <section class="section">
        <div class="wrap">
            <div class="split items-center">
                <div class="reveal-left">
                    <span class="kicker" data-index="01">{{ $page->get('histoire.kicker', 'Notre histoire') }}</span>
                    <h2 class="title-xl">{{ $page->get('histoire.title', 'Une expertise congolaise née sur le terrain') }}</h2>
                    <div class="story-write" data-write>
                        @php
                            $paragraphs = array_filter(explode("\n\n", $page->get('histoire.paragraphs', '')));
                        @endphp
                        @forelse ($paragraphs as $index => $paragraph)
                            <p class="{{ $index === 0 ? 'lead mt-3' : 'mt-2 text-body' }}">{{ $paragraph }}</p>
                        @empty
                            <p class="lead mt-3">La Société de Forages Pétroliers (SFP) est créée en 2010, filiale à 100 % du groupe SNPC (Société Nationale des Pétroles du Congo), avec une ambition claire : bâtir une expertise nationale capable de rivaliser avec les meilleurs prestataires internationaux du forage pétrolier.</p>
                        @endforelse
                    </div>
                    <a href="{{ route('carrieres.index') }}" class="link-arrow mt-4">Rejoindre nos équipes <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                </div>

                <div class="reveal-right">
                    <div class="frame">
                        <div class="media hover">
                            <picture>
                                <source type="image/webp" srcset="{{ asset('images/opt/leadership.webp') }}" />
                                <img src="{{ asset('images/opt/leadership.jpg') }}" alt="Direction et équipes SFP réunies lors d'une cérémonie sur site" loading="lazy" width="2000" height="1500" />
                            </picture>
                        </div>
                        <div class="plate">
                            <b>SNPC</b>
                            <span>Filiale du groupe · 100 %</span>
                        </div>
                        <span class="pill pill-y tag-corner">Depuis 2010</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Domaines d'expertise -->
    <section class="section bg-industrial">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker" data-index="02">{{ $page->get('expertise.kicker', 'Savoir-faire') }}</span>
                <h2 class="title-xl">{{ $page->get('expertise.title', "Nos domaines d'expertise") }}</h2>
                <p class="lead mx-auto maxw-md mt-2">{{ $page->get('expertise.lead', 'Du forage à la diversification des services techniques, une chaîne de compétences maîtrisée de bout en bout.') }}</p>
            </div>
            <div class="cap-grid stagger">
                @foreach ($expertise as $cap)
                    <article class="cap">
                        <span class="cap-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="cap-ico"><i class="hgi-stroke {{ $cap->icon }}"></i></span>
                        <h4>{{ $cap->title }}</h4>
                        <p>{{ $cap->description }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Vision · Mission · Objectifs -->
    <section class="section">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker" data-index="03">{{ $page->get('pillars.kicker', 'Cap stratégique') }}</span>
                <h2 class="title-xl">{{ $page->get('pillars.title', 'Vision, mission & objectifs') }}</h2>
            </div>
            <div class="pillars stagger">
                @foreach ($pillars as $pillar)
                    <article @class(['pillar', 'pillar-feature' => $loop->iteration === 2])>
                        <span class="pillar-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="pillar-ico"><i class="hgi-stroke {{ $pillar->icon }}"></i></span>
                        <span class="pillar-label">{{ $pillar->meta['label'] ?? '' }}</span>
                        <h4>{{ $pillar->title }}</h4>
                        <p>{{ $pillar->description }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Chiffres clés -->
    <section class="section-tight bg-charcoal noise">
        <div class="wrap">
            <div class="stat-band">
                <div class="stat">
                    <div class="n" data-count="{{ now()->year - ($settings->founding_year ?? 2011) }}" data-suffix="+">0</div>
                    <div class="l">Années d'expérience</div>
                </div>
                <div class="stat">
                    <div class="n" data-count="{{ $settings->rigs_count ?? 2 }}">0</div>
                    <div class="l">Rigs de forage</div>
                </div>
                <div class="stat">
                    <div class="n">24<span style="font-size:0.5em">/</span>7</div>
                    <div class="l">Opérations continues</div>
                </div>
                <div class="stat">
                    <div class="n" data-count="{{ $settings->incidents_count ?? 0 }}" data-literal="{{ $settings->incidents_count ?? 0 }}">0</div>
                    <div class="l">Incident depuis {{ $settings->founding_year ?? 2011 }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Frise -->
    <section class="section bg-industrial">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker" data-index="04">{{ $page->get('timeline.kicker', 'Parcours') }}</span>
                <h2 class="title-xl">{{ $page->get('timeline.title', 'Les grandes étapes de la SFP') }}</h2>
            </div>

            <div class="drill-log">
                @foreach ($milestones as $milestone)
                    <article class="drill-log-entry">
                        <div class="drill-log-axis">
                            <span class="drill-log-date">{{ $milestone->year_label }}</span>
                            <span class="drill-log-node"></span>
                        </div>
                        <div class="drill-log-card">
                            <div class="drill-log-body">
                                @if ($milestone->category)
                                    <span class="pill cat">{{ $milestone->category }}</span>
                                @endif
                                <h3>{{ $milestone->title }}</h3>
                                <p>{{ $milestone->description }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Valeurs -->
    <section class="section">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker" data-index="05">{{ $page->get('values.kicker', 'Nos valeurs') }}</span>
                <h2 class="title-xl">{{ $page->get('values.title', 'Ce qui guide chacune de nos opérations') }}</h2>
            </div>
            <div class="perks stagger">
                @foreach ($values as $value)
                    <div class="perk"><i class="hgi-stroke {{ $value->icon }}"></i><h4>{{ $value->title }}</h4><p>{{ $value->description }}</p></div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section-tight bg-charcoal noise section-photo careers-cta">
        <div class="wrap">
            <div class="careers-cta-inner reveal">
                <div>
                    <span class="kicker on-dark" data-index="06">{{ $page->get('cta.kicker', 'Rejoignez-nous') }}</span>
                    <h2 class="title-xl on-dark">{{ $page->get('cta.title', 'Envie de participer à nos opérations ?') }}</h2>
                    <p class="lead mt-2">{{ $page->get('cta.lead', "Découvrez nos offres d'emploi et rejoignez une équipe d'excellence au service de l'énergie congolaise.") }}</p>
                </div>
                <div class="careers-cta-actions">
                    <a href="{{ route('carrieres.index') }}" class="btn btn-primary">{{ $page->get('cta.button_label', "Voir les offres d'emploi") }} <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
