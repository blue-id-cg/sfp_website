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
        'kicker' => 'L\'entreprise',
        'title' => 'À propos de la SFP',
        'lead' => "L'expertise congolaise du forage pétrolier, au service des grands opérateurs du secteur.",
    ])

    <!-- Histoire -->
    <section class="section">
        <div class="wrap">
            <div class="split items-center">
                <div class="reveal-left">
                    <span class="kicker" data-index="01">Notre histoire</span>
                    <h2 class="title-xl">Une expertise <span class="mark accent">congolaise</span> née sur le terrain</h2>
                    <p class="lead mt-3">
                        La <strong>Société de Forages Pétroliers (SFP)</strong> est créée en 2010, filiale à 100 % du
                        groupe <strong>SNPC</strong> (Société Nationale des Pétroles du Congo), avec une ambition claire :
                        bâtir une expertise nationale capable de rivaliser avec les meilleurs prestataires internationaux
                        du forage pétrolier.
                    </p>
                    <p class="mt-2 text-body">
                        L'entreprise démarre ses opérations en septembre 2011, sur le premier marché MKB
                        (Mengo-Kudji-Bindi) attribué à la SNPC. Cette première campagne pose les fondations de la
                        méthode SFP : rigueur technique, discipline opérationnelle et culture de sécurité affirmée
                        dès les premiers puits forés.
                    </p>
                    <p class="mt-2 text-body">
                        Depuis, la SFP a élargi son champ d'intervention au forage, à la complétion et au work over,
                        en assurant plusieurs puits onshore forés sans incident pour les acteurs majeurs du secteur
                        pétrolier congolais. Cette continuité opérationnelle, sans accroc, est aujourd'hui la meilleure
                        garantie que l'entreprise peut offrir à ses partenaires.
                    </p>
                    <p class="mt-2 text-body">
                        Ce socle repose sur des équipes congolaises formées aux meilleurs standards internationaux, qui
                        opèrent des appareils de forage modernes dans le respect strict des normes de sécurité et
                        d'environnement en vigueur dans l'industrie pétrolière.
                    </p>
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
                <span class="kicker" data-index="02">Savoir-faire</span>
                <h2 class="title-xl">Nos domaines d'expertise</h2>
                <p class="lead mx-auto maxw-md mt-2">Du forage à la diversification des services techniques, une chaîne de compétences maîtrisée de bout en bout.</p>
            </div>
            <div class="perks stagger">
                <div class="perk"><i class="hgi-stroke hgi-factory-01"></i><h4>Forage</h4><p>Conduite d'opérations de forage onshore, de la mobilisation à la finalisation du puits.</p></div>
                <div class="perk"><i class="hgi-stroke hgi-layers-01"></i><h4>Complétion</h4><p>Mise en production des puits dans le respect des standards techniques et de sécurité.</p></div>
                <div class="perk"><i class="hgi-stroke hgi-refresh"></i><h4>Work over</h4><p>Interventions de reprise et de réhabilitation sur puits existants (ZNG-1D, ZNG-4D, ZNG-3D…).</p></div>
                <div class="perk"><i class="hgi-stroke hgi-chart-line-data-01"></i><h4>Mud logging</h4><p>Suivi géologique et analyse en temps réel des paramètres de forage.</p></div>
                <div class="perk"><i class="hgi-stroke hgi-dashboard-speed-01"></i><h4>CTR</h4><p>Services de contrôle et de suivi technique des opérations de forage.</p></div>
                <div class="perk"><i class="hgi-stroke hgi-filter"></i><h4>Pompage &amp; filtration</h4><p>Gestion complète des fluides de forage, du pompage à la filtration.</p></div>
            </div>
        </div>
    </section>

    <!-- Vision · Mission · Objectifs -->
    <section class="section">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker" data-index="03">Cap stratégique</span>
                <h2 class="title-xl">Vision, mission &amp; objectifs</h2>
            </div>
            <div class="perks stagger">
                <div class="perk">
                    <i class="hgi-stroke hgi-compass-01"></i>
                    <h4>Vision</h4>
                    <p>Être un leader des métiers du forage et des services.</p>
                </div>
                <div class="perk">
                    <i class="hgi-stroke hgi-target-01"></i>
                    <h4>Mission</h4>
                    <p>Accompagner la SNPC dans le développement de ses actifs opérés et gagner des parts de marché hors groupe SNPC, dans le forage et les services, pour accroître nos performances.</p>
                </div>
                <div class="perk">
                    <i class="hgi-stroke hgi-flag-01"></i>
                    <h4>Objectifs 2026-2027</h4>
                    <p>Réhabiliter nos équipements pour terminer le forage de NAN-201, forer NAN-301 et NAN-302, réaliser les work-overs de ZNG-1D, ZNG-4D et ZNG-3D en 2026 ; puis fournir des services de Mud Logging, CTR, pompage et filtration, et forer jusqu'à 6 puits de développement ou 4 puits d'exploration en 2027.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Chiffres clés -->
    <section class="section-tight bg-charcoal noise">
        <div class="wrap">
            <div class="stat-band">
                <div class="stat">
                    <div class="n" data-count="{{ now()->year - 2011 }}" data-suffix="+">0</div>
                    <div class="l">Années d'expérience</div>
                </div>
                <div class="stat">
                    <div class="n" data-count="2">0</div>
                    <div class="l">Rigs de forage</div>
                </div>
                <div class="stat">
                    <div class="n">24<span style="font-size:0.5em">/</span>7</div>
                    <div class="l">Opérations continues</div>
                </div>
                <div class="stat">
                    <div class="n" data-count="0" data-literal="0">0</div>
                    <div class="l">Incident depuis 2011</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Frise -->
    <section class="section bg-industrial">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker" data-index="04">Parcours</span>
                <h2 class="title-xl">Les grandes étapes de la SFP</h2>
            </div>

            <div class="drill-log">
                <article class="drill-log-entry">
                    <div class="drill-log-axis">
                        <span class="drill-log-date">2010</span>
                        <span class="drill-log-node"></span>
                    </div>
                    <div class="drill-log-card">
                        <div class="drill-log-body">
                            <span class="pill cat">Création</span>
                            <h3>Naissance de la SFP</h3>
                            <p>La Société de Forages Pétroliers est créée comme filiale à 100 % du groupe SNPC, avec l'ambition de bâtir une expertise congolaise du forage pétrolier.</p>
                        </div>
                    </div>
                </article>
                <article class="drill-log-entry">
                    <div class="drill-log-axis">
                        <span class="drill-log-date">2011</span>
                        <span class="drill-log-node"></span>
                    </div>
                    <div class="drill-log-card">
                        <div class="drill-log-body">
                            <span class="pill cat">Premières opérations</span>
                            <h3>Démarrage sur le marché MKB</h3>
                            <p>La SFP démarre ses opérations en septembre 2011 sur le premier marché Mengo-Kudji-Bindi (MKB) attribué à la SNPC.</p>
                        </div>
                    </div>
                </article>
                <article class="drill-log-entry">
                    <div class="drill-log-axis">
                        <span class="drill-log-date">Depuis</span>
                        <span class="drill-log-node"></span>
                    </div>
                    <div class="drill-log-card">
                        <div class="drill-log-body">
                            <span class="pill cat">Croissance</span>
                            <h3>Une expertise reconnue</h3>
                            <p>Plusieurs puits onshore ont été forés sans incident pour les acteurs majeurs du secteur pétrolier congolais, consolidant la réputation de fiabilité de la SFP.</p>
                        </div>
                    </div>
                </article>
                <article class="drill-log-entry">
                    <div class="drill-log-axis">
                        <span class="drill-log-date">Aujourd'hui</span>
                        <span class="drill-log-node"></span>
                    </div>
                    <div class="drill-log-card">
                        <div class="drill-log-body">
                            <span class="pill cat">Aujourd'hui</span>
                            <h3>Excellence &amp; sécurité au quotidien</h3>
                            <p>La SFP poursuit ses opérations avec une culture HSE exigeante et continue d'investir dans la formation et la modernisation de ses équipements.</p>
                        </div>
                    </div>
                </article>
                <article class="drill-log-entry">
                    <div class="drill-log-axis">
                        <span class="drill-log-date">2026</span>
                        <span class="drill-log-node"></span>
                    </div>
                    <div class="drill-log-card">
                        <div class="drill-log-body">
                            <span class="pill cat">Objectif</span>
                            <h3>Réhabilitation &amp; nouveaux forages</h3>
                            <p>Réhabiliter nos équipements afin de terminer le forage de NAN-201, forer NAN-301 et NAN-302, et réaliser les work-overs de ZNG-1D, ZNG-4D et ZNG-3D.</p>
                        </div>
                    </div>
                </article>
                <article class="drill-log-entry">
                    <div class="drill-log-axis">
                        <span class="drill-log-date">2027</span>
                        <span class="drill-log-node"></span>
                    </div>
                    <div class="drill-log-card">
                        <div class="drill-log-body">
                            <span class="pill cat">Objectif</span>
                            <h3>Diversification des services</h3>
                            <p>Fournir divers services (Mud Logging, CTR, pompage, filtration) puis forer jusqu'à 6 puits de développement ou 4 puits d'exploration.</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Valeurs -->
    <section class="section">
        <div class="wrap">
            <div class="sec-head center reveal mb-4">
                <span class="kicker" data-index="05">Nos valeurs</span>
                <h2 class="title-xl">Ce qui guide chacune de nos opérations</h2>
            </div>
            <div class="perks stagger">
                <div class="perk"><i class="hgi-stroke hgi-vest"></i><h4>Sécurité avant tout</h4><p>Une culture HSE exigeante et un objectif constant de zéro incident sur chaque site.</p></div>
                <div class="perk"><i class="hgi-stroke hgi-target-01"></i><h4>Excellence opérationnelle</h4><p>Des standards élevés et une amélioration continue dans chaque phase de nos opérations.</p></div>
                <div class="perk"><i class="hgi-stroke hgi-agreement-01"></i><h4>Fiabilité &amp; transparence</h4><p>Un partenaire de confiance pour des projets pétroliers complexes et exigeants.</p></div>
                <div class="perk"><i class="hgi-stroke hgi-user-group"></i><h4>Expertise congolaise</h4><p>Des équipes locales formées aux meilleurs standards internationaux du forage.</p></div>
                <div class="perk"><i class="hgi-stroke hgi-leaf-01"></i><h4>Respect de l'environnement</h4><p>Une maîtrise des risques industriels conforme aux normes internationales.</p></div>
                <div class="perk"><i class="hgi-stroke hgi-factory-01"></i><h4>Filiale du groupe SNPC</h4><p>L'appui et la solidité d'un groupe national de référence dans le secteur pétrolier.</p></div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section-tight bg-charcoal noise section-photo careers-cta">
        <div class="wrap">
            <div class="careers-cta-inner reveal">
                <div>
                    <span class="kicker on-dark" data-index="06">Rejoignez-nous</span>
                    <h2 class="title-xl on-dark">Envie de participer à nos opérations ?</h2>
                    <p class="lead mt-2">Découvrez nos offres d'emploi et rejoignez une équipe d'excellence au service de l'énergie congolaise.</p>
                </div>
                <div class="careers-cta-actions">
                    <a href="{{ route('carrieres.index') }}" class="btn btn-primary">Voir les offres d'emploi <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
