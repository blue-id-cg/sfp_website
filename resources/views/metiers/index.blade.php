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
        'kicker' => 'Nos métiers',
        'title' => 'Le cycle de vie du puits, maîtrisé de bout en bout',
        'lead' => "De la préparation des opérations à la maintenance des installations, nos équipes couvrent l'ensemble des disciplines du forage pétrolier avec des équipements spécialisés.",
    ])

    <section class="section">
        <div class="wrap">
            <div class="trade-grid stagger">
                <article class="trade">
                    <div class="num">01</div>
                    <div class="ico"><i class="hgi-stroke hgi-factory-01"></i></div>
                    <h3>Forage pétrolier</h3>
                    <p>Réalisation de puits d'exploration, d'évaluation et de production, avec des protocoles de sécurité stricts et un pilotage précis des paramètres.</p>
                </article>
                <article class="trade">
                    <div class="num">02</div>
                    <div class="ico"><i class="hgi-stroke hgi-layers-01"></i></div>
                    <h3>Complétion</h3>
                    <p>Équipement et mise en production des puits pour garantir un débit optimal, durable et conforme aux exigences du réservoir.</p>
                </article>
                <article class="trade">
                    <div class="num">03</div>
                    <div class="ico"><i class="hgi-stroke hgi-refresh"></i></div>
                    <h3>Work Over</h3>
                    <p>Reprise, réparation et amélioration des performances des puits existants pour prolonger leur durée de vie et leur productivité.</p>
                </article>
                <article class="trade">
                    <div class="num">04</div>
                    <div class="ico"><i class="hgi-stroke hgi-chart-line-data-01"></i></div>
                    <h3>Mud Logging</h3>
                    <p>Suivi géologique en temps réel et analyse des données de forage pour une prise de décision éclairée à chaque phase.</p>
                </article>
                <article class="trade">
                    <div class="num">05</div>
                    <div class="ico"><i class="hgi-stroke hgi-filter"></i></div>
                    <h3>Pompage &amp; Filtration</h3>
                    <p>Gestion complète des fluides techniques · du pompage à la filtration · pour des opérations propres, stables et efficaces.</p>
                </article>
                <article class="trade">
                    <div class="num">06</div>
                    <div class="ico"><i class="hgi-stroke hgi-settings-02"></i></div>
                    <h3>Casing &amp; Tubing</h3>
                    <p>Descente et vissage de casing et de tubing sur les puits en cours de forage ou de complétion.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section bg-industrial">
        <div class="wrap">
            <div class="split reverse items-center">
                <div class="reveal-right">
                    <span class="kicker" data-index="01">Innovation</span>
                    <h2 class="title-xl">Performance <span class="mark accent">opérationnelle</span> &amp; digitalisation</h2>
                    <p class="lead mt-3">Nous intégrons les technologies les plus avancées pour optimiser chaque phase de nos opérations : de la surveillance en temps réel à l'analyse des données, jusqu'à la modernisation des équipements.</p>

                    <ul class="feature-list">
                        <li><span class="ico"><i class="hgi-stroke hgi-dashboard-speed-01"></i></span><div><h4>Surveillance en temps réel</h4><p>Contrôle continu des paramètres de forage pour des décisions rapides et sûres.</p></div></li>
                        <li><span class="ico"><i class="hgi-stroke hgi-cpu"></i></span><div><h4>Digitalisation des opérations</h4><p>Systèmes connectés pour gagner en efficacité, en traçabilité et en fiabilité.</p></div></li>
                        <li><span class="ico"><i class="hgi-stroke hgi-focus-point"></i></span><div><h4>Optimisation par la donnée</h4><p>Amélioration continue des performances fondée sur l'analyse des indicateurs.</p></div></li>
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
                    <span class="kicker on-dark" data-index="02">Rejoignez-nous</span>
                    <h2 class="title-xl on-dark">Envie de mettre votre expertise au service du forage ?</h2>
                    <p class="lead mt-2">Découvrez nos offres d'emploi et rejoignez une équipe d'excellence au service de l'énergie congolaise.</p>
                </div>
                <div class="careers-cta-actions">
                    <a href="{{ route('carrieres.index') }}" class="btn btn-primary">Voir les offres d'emploi <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
