<!-- ===== RÉALISATIONS ===== -->
<section id="realisations" class="section">
    @include('partials.strata-divider', ['color' => '#fff'])
    <span class="ghost-index" aria-hidden="true">07</span>
    <div class="wrap">
        <div class="sec-head-split mb-4">
            <div class="reveal">
                <span class="kicker" data-index="07">Nos réalisations</span>
                <h2 class="title-xl">Des opérations menées<br />avec exigence</h2>
            </div>
            <div class="r reveal">
                <p class="lead">Un aperçu des opérations à l'actif de la SFP depuis le démarrage de ses activités en 2011.</p>
            </div>
        </div>

        <div class="projects stagger">
            <article class="project" data-lightbox data-full="{{ asset('images/opt/rig-stairs.jpg') }}">
                <picture><source type="image/webp" srcset="{{ asset('images/opt/rig-stairs.webp') }}" /><img src="{{ asset('images/opt/rig-stairs.jpg') }}" alt="Appareil de forage lors d'une campagne onshore à Kundji" loading="lazy" /></picture>
                <div class="project-top">
                    <span class="op-index">Opération 01</span>
                    <span class="op-stamp"><i class="fa-solid fa-circle-check"></i> Réalisé</span>
                </div>
                <div class="meta">
                    <span class="pill pill-y">Forage · Onshore</span>
                    <h3>Forage de puits à Kundji</h3>
                    <p>Réalisation de puits en environnement onshore, dans le respect des standards de sécurité et de qualité.</p>
                    <ul class="op-facts">
                        <li><i class="fa-solid fa-location-dot"></i> Kundji</li>
                        <li><i class="fa-solid fa-bullseye"></i> Forage onshore</li>
                    </ul>
                </div>
                <span class="op-cta">Voir l'opération <i class="hgi-stroke hgi-arrow-right-01"></i></span>
            </article>
            <article class="project" data-lightbox data-full="{{ asset('images/opt/crew-mudpumps.jpg') }}">
                <picture><source type="image/webp" srcset="{{ asset('images/opt/crew-mudpumps-m.webp') }}" /><img src="{{ asset('images/opt/crew-mudpumps-m.jpg') }}" alt="Opération de work over sur un puits existant" loading="lazy" /></picture>
                <div class="project-top">
                    <span class="op-index">Opération 02</span>
                    <span class="op-stamp"><i class="fa-solid fa-circle-check"></i> Réalisé</span>
                </div>
                <div class="meta">
                    <span class="pill pill-y">Work Over</span>
                    <h3>Workovers à Kundji, Mbondji &amp; Zingali</h3>
                    <p>Interventions de work over pour restaurer et améliorer la performance de puits en production, complétées par nos services de mud logging et de CTR pendant les forages.</p>
                    <ul class="op-facts">
                        <li><i class="fa-solid fa-location-dot"></i> Kundji · Mbondji · Zingali</li>
                        <li><i class="fa-solid fa-layer-group"></i> 3 sites</li>
                    </ul>
                    <div class="op-tags">
                        <span>Mud logging</span>
                        <span>CTR</span>
                    </div>
                </div>
                <span class="op-cta">Voir l'opération <i class="hgi-stroke hgi-arrow-right-01"></i></span>
            </article>
        </div>
    </div>
</section>
