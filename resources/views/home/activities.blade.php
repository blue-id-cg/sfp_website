<!-- ===== NOS MÉTIERS (aperçu) · Coupe de puits interactive ===== -->
<section class="section wellbore-sec bg-petrol noise on-dark">
    <span class="ghost-index on-dark" aria-hidden="true">02</span>
    <div class="wrap">
        <div class="sec-head-split mb-4">
            <div class="reveal">
                <span class="kicker" data-index="02">Nos métiers</span>
                <h2 class="title-xl">Le cycle de vie du puits,<br />maîtrisé de bout en bout</h2>
            </div>
            <div class="r reveal">
                <p class="lead">De la préparation des opérations à la maintenance des installations, nos équipes couvrent l'ensemble des disciplines du forage pétrolier.</p>
                <a href="{{ route('metiers.index') }}" class="link-arrow mt-3">Découvrir tous nos métiers <i class="hgi-stroke hgi-arrow-right-01"></i></a>
            </div>
        </div>

        <div class="wellbore reveal" data-active="1">
            <!-- Coupe de puits (visuel) -->
            <div class="wellbore-viz" aria-hidden="true">
                <div class="wb-readout">
                    <span class="wb-readout-eyebrow">Sur le puits</span>
                    <span class="wb-readout-value" data-wb-readout>Forage pétrolier</span>
                </div>
                <svg class="wb-svg" viewBox="0 0 300 540" role="presentation" preserveAspectRatio="xMidYMid meet">
                    <!-- Strates (profondeur) -->
                    <g class="wb-strata">
                        <rect x="0" y="84" width="300" height="96" class="wb-layer l1" />
                        <rect x="0" y="180" width="300" height="130" class="wb-layer l2" />
                        <rect x="0" y="310" width="300" height="140" class="wb-layer l3" />
                        <rect x="0" y="450" width="300" height="90" class="wb-layer l4" />
                    </g>

                    <!-- Sol -->
                    <line x1="16" y1="84" x2="284" y2="84" class="wb-ground" />

                    <!-- Derrick -->
                    <g class="wb-derrick">
                        <line x1="150" y1="20" x2="126" y2="84" />
                        <line x1="150" y1="20" x2="174" y2="84" />
                        <line x1="138" y1="52" x2="162" y2="52" />
                        <line x1="132" y1="68" x2="168" y2="68" />
                        <rect x="144" y="12" width="12" height="10" rx="2" />
                    </g>

                    <!-- Ruler / échelle de profondeur -->
                    <g class="wb-ruler">
                        <line x1="44" y1="96" x2="44" y2="512" />
                        <line x1="38" y1="130" x2="44" y2="130" /><line x1="38" y1="170" x2="44" y2="170" />
                        <line x1="38" y1="210" x2="44" y2="210" /><line x1="38" y1="250" x2="44" y2="250" />
                        <line x1="38" y1="290" x2="44" y2="290" /><line x1="38" y1="330" x2="44" y2="330" />
                        <line x1="38" y1="370" x2="44" y2="370" /><line x1="38" y1="410" x2="44" y2="410" />
                        <line x1="38" y1="450" x2="44" y2="450" /><line x1="38" y1="490" x2="44" y2="490" />
                    </g>

                    <!-- Puits (casing) -->
                    <line x1="142" y1="84" x2="142" y2="516" class="wb-casing" />
                    <line x1="158" y1="84" x2="158" y2="516" class="wb-casing" />
                    <line x1="150" y1="84" x2="150" y2="516" class="wb-axis" />

                    <!-- Stations -->
                    <g class="wb-station" data-st="1">
                        <circle cx="150" cy="170" r="20" class="wb-halo" />
                        <circle cx="150" cy="170" r="11" class="wb-node" />
                        <text x="150" y="174" class="wb-stnum">01</text>
                    </g>
                    <g class="wb-station" data-st="2">
                        <circle cx="150" cy="310" r="20" class="wb-halo" />
                        <circle cx="150" cy="310" r="11" class="wb-node" />
                        <text x="150" y="314" class="wb-stnum">02</text>
                    </g>
                    <g class="wb-station" data-st="3">
                        <circle cx="150" cy="450" r="20" class="wb-halo" />
                        <circle cx="150" cy="450" r="11" class="wb-node" />
                        <text x="150" y="454" class="wb-stnum">03</text>
                    </g>

                    <!-- Trépan (drill bit) qui descend -->
                    <g class="wb-bit">
                        <line x1="150" y1="84" x2="150" y2="158" class="wb-string" />
                        <circle cx="150" cy="170" r="7" class="wb-bit-core" />
                        <path d="M143 174 L150 186 L157 174 Z" class="wb-bit-tip" />
                    </g>
                </svg>
            </div>

            <!-- Phases (contenu, toujours visible) -->
            <div class="wellbore-phases" role="tablist" aria-label="Phases du cycle de vie du puits">
                <button type="button" class="phase-row" data-phase="1" aria-current="true">
                    <span class="phase-row-index">01</span>
                    <span class="phase-row-ico"><i class="hgi-stroke hgi-factory-01"></i></span>
                    <span class="phase-row-body">
                        <span class="phase-row-head">
                            <span class="phase-row-eyebrow">Phase 01 · Forage</span>
                            <span class="phase-row-title">Forage pétrolier</span>
                        </span>
                        <span class="phase-row-desc">Réalisation de puits d'exploration, d'évaluation et de production, avec des protocoles de sécurité stricts.</span>
                        <span class="phase-row-tags">
                            <span>Exploration</span><span>Évaluation</span><span>Production</span>
                        </span>
                    </span>
                    <i class="hgi-stroke hgi-arrow-right-01 phase-row-arrow"></i>
                </button>

                <button type="button" class="phase-row" data-phase="2" aria-current="false">
                    <span class="phase-row-index">02</span>
                    <span class="phase-row-ico"><i class="hgi-stroke hgi-layers-01"></i></span>
                    <span class="phase-row-body">
                        <span class="phase-row-head">
                            <span class="phase-row-eyebrow">Phase 02 · Complétion</span>
                            <span class="phase-row-title">Complétion</span>
                        </span>
                        <span class="phase-row-desc">Équipement et mise en production des puits pour garantir un débit optimal et durable.</span>
                        <span class="phase-row-tags">
                            <span>Équipement</span><span>Mise en production</span><span>Débit optimal</span>
                        </span>
                    </span>
                    <i class="hgi-stroke hgi-arrow-right-01 phase-row-arrow"></i>
                </button>

                <button type="button" class="phase-row" data-phase="3" aria-current="false">
                    <span class="phase-row-index">03</span>
                    <span class="phase-row-ico"><i class="hgi-stroke hgi-refresh"></i></span>
                    <span class="phase-row-body">
                        <span class="phase-row-head">
                            <span class="phase-row-eyebrow">Phase 03 · Work Over</span>
                            <span class="phase-row-title">Work Over</span>
                        </span>
                        <span class="phase-row-desc">Reprise et amélioration des performances des puits existants pour prolonger leur productivité.</span>
                        <span class="phase-row-tags">
                            <span>Reprise</span><span>Optimisation</span><span>Productivité</span>
                        </span>
                    </span>
                    <i class="hgi-stroke hgi-arrow-right-01 phase-row-arrow"></i>
                </button>
            </div>
        </div>
    </div>
</section>
