<!-- ===== INNOVATION · Console de supervision ===== -->
<section id="innovation" class="section innov">
    <span class="ghost-index" aria-hidden="true">03</span>
    <div class="wrap">
        <div class="sec-head-split mb-4">
            <div class="reveal">
                <span class="kicker" data-index="03">{{ $page->get('technology.kicker', 'Innovation') }}</span>
                <h2 class="title-xl">{{ $page->get('technology.title', 'Performance opérationnelle & digitalisation') }}</h2>
            </div>
            <div class="r reveal">
                <p class="lead">{{ $page->get('technology.lead', "Nous intégrons les technologies les plus avancées pour optimiser chaque phase de nos opérations : de la surveillance en temps réel à l'analyse des données, jusqu'à la modernisation des équipements.") }}</p>
            </div>
        </div>

        <div class="console">
            <!-- Visuel + HUD télémétrie -->
            <figure class="console-visual reveal-left">
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

                    <div class="hud" aria-hidden="true">
                        <div class="hud-top">
                            <span class="hud-live"><span class="hud-dot"></span>En direct</span>
                            <span class="hud-tag">Paramètres de forage</span>
                        </div>
                        <svg class="hud-chart" viewBox="0 0 240 64" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="hudFill" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#fae700" stop-opacity="0.35" />
                                    <stop offset="100%" stop-color="#fae700" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            <polygon class="hud-area" points="0,48 24,36 48,44 72,20 96,34 120,14 144,30 168,10 192,26 216,8 240,20 240,64 0,64" fill="url(#hudFill)" />
                            <polyline class="hud-line" points="0,48 24,36 48,44 72,20 96,34 120,14 144,30 168,10 192,26 216,8 240,20" />
                        </svg>
                        <div class="hud-metrics">
                            <span><b>ROP</b> Vitesse d'avancement</span>
                            <span><b>WOB</b> Poids sur l'outil</span>
                            <span><b>RPM</b> Rotation</span>
                        </div>
                    </div>
                </div>
            </figure>

            <!-- Instruments -->
            <div class="console-tiles stagger">
                @foreach ($instruments as $instrument)
                    <article class="inst">
                        <span class="inst-ico"><i class="hgi-stroke {{ $instrument->icon }}"></i></span>
                        <div class="inst-body">
                            <h4>{{ $instrument->title }}</h4>
                            <p>{{ $instrument->description }}</p>
                        </div>
                        <span class="inst-signal" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></span>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
