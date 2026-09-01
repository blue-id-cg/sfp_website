@extends('layouts.app', [
    'title' => 'Nos équipements · SFP · Société de Forages Pétroliers',
    'description' => "Le parc industriel de la SFP : rigs MR-8000 Drillmec et MR-3500, et une base opérationnelle de 30 000 m² à Djeno.",
])

@section('content')
    @include('partials.page-head', [
        'image' => 'rig-sky',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Équipements', 'url' => null],
        ],
        'kicker' => $page->get('intro.kicker', 'Équipements'),
        'title' => $page->get('intro.title', 'Un parc industriel à la hauteur des enjeux'),
        'lead' => $page->get('intro.lead', "Deux rigs, le MR-8000 Drillmec (1080 HP) et le MR-3500, ainsi qu'une base opérationnelle de 30 000 m² à Djeno pour la réception, le stockage et l'entretien des équipements avant leur déploiement sur site."),
    ])

    <section class="section">
        <div class="wrap">
            <div class="bento reveal-scale">
                <figure class="cell" data-lightbox>
                    <picture>
                        <source type="image/webp" srcset="{{ asset('images/opt/rig-sky.webp') }}" />
                        <img src="{{ asset('images/opt/rig-sky.jpg') }}" alt="Rig MR-8000 Drillmec de la SFP dressé sous le ciel, mât de 1080 HP" loading="lazy" />
                    </picture>
                    <figcaption class="cap"><h4>Rig MR&#8209;8000 Drillmec</h4><span>1080 HP</span></figcaption>
                </figure>
                <figure class="cell" data-lightbox>
                    <picture>
                        <source type="image/webp" srcset="{{ asset('images/opt/rig03-unit-m.webp') }}" />
                        <img src="{{ asset('images/opt/rig03-unit-m.jpg') }}" alt="Unité de forage mobile MR-3500" loading="lazy" />
                    </picture>
                    <figcaption class="cap"><h4>Unité mobile MR&#8209;3500</h4><span>Base de Djeno</span></figcaption>
                </figure>
                <figure class="cell" data-lightbox>
                    <picture>
                        <source type="image/webp" srcset="{{ asset('images/opt/mobilization.webp') }}" />
                        <img src="{{ asset('images/opt/mobilization.jpg') }}" alt="Grues mobiles lors de la mobilisation et du montage d'un appareil de forage" loading="lazy" />
                    </picture>
                    <figcaption class="cap"><h4>Mobilisation</h4><span>Levage &amp; rig-up</span></figcaption>
                </figure>
                <figure class="cell" data-lightbox>
                    <picture>
                        <source type="image/webp" srcset="{{ asset('images/opt/crew-platform-m.webp') }}" />
                        <img src="{{ asset('images/opt/crew-platform-m.jpg') }}" alt="Opérations des équipes SFP sur le plancher de forage" loading="lazy" />
                    </picture>
                    <figcaption class="cap"><h4>Opérations sur site</h4><span>Plancher de forage</span></figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="section bg-industrial">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker" data-index="01">{{ $page->get('base.kicker', 'Base de Djeno') }}</span>
                <h2 class="title-xl">{{ $page->get('base.title', '30 000 m² dédiés à la préparation des opérations') }}</h2>
                <p class="lead mx-auto maxw-md mt-2">{{ $page->get('base.lead', 'Réception, stockage, entretien et remise en état des équipements avant chaque mobilisation sur site.') }}</p>
            </div>
            <div class="perks stagger">
                @foreach ($perks as $perk)
                    <div class="perk"><i class="hgi-stroke {{ $perk->icon }}"></i><h4>{{ $perk->title }}</h4><p>{{ $perk->description }}</p></div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-tight bg-charcoal noise section-photo careers-cta">
        <div class="wrap">
            <div class="careers-cta-inner reveal">
                <div>
                    <span class="kicker on-dark" data-index="02">{{ $page->get('cta.kicker', 'Rejoignez-nous') }}</span>
                    <h2 class="title-xl on-dark">{{ $page->get('cta.title', 'Envie de travailler sur nos appareils de forage ?') }}</h2>
                    <p class="lead mt-2">{{ $page->get('cta.lead', "Découvrez nos offres d'emploi et rejoignez une équipe d'excellence au service de l'énergie congolaise.") }}</p>
                </div>
                <div class="careers-cta-actions">
                    <a href="{{ route('carrieres.index') }}" class="btn btn-primary">{{ $page->get('cta.button_label', "Voir les offres d'emploi") }} <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
