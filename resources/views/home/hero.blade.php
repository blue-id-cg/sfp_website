<!-- ===== HERO ===== -->
<section id="accueil" class="hero">
    <div class="hero-media" data-parallax="0.08">
        <div class="slide">
            <picture>
                <source type="image/webp" srcset="{{ asset('images/opt/rig-tall.webp') }}" />
                <img src="{{ asset('images/opt/rig-tall.jpg') }}" alt="Appareil de forage SFP en opération sur un site pétrolier au Congo" fetchpriority="high" width="1650" height="2200" />
            </picture>
        </div>
        <div class="slide">
            <picture>
                <source type="image/webp" srcset="{{ asset('images/opt/crew-platform.webp') }}" />
                <img src="{{ asset('images/opt/crew-platform.jpg') }}" alt="Équipes SFP sur le plancher de forage" loading="lazy" width="1650" height="2200" />
            </picture>
        </div>
        <div class="slide">
            <picture>
                <source type="image/webp" srcset="{{ asset('images/opt/rig-flag.webp') }}" />
                <img src="{{ asset('images/opt/rig-flag.jpg') }}" alt="Mât de forage et drapeau du Congo" loading="lazy" width="1650" height="2200" />
            </picture>
        </div>
        <div class="slide">
            <picture>
                <source type="image/webp" srcset="{{ asset('images/opt/mobilization.webp') }}" />
                <img src="{{ asset('images/opt/mobilization.jpg') }}" alt="Mobilisation d'un appareil de forage à la grue" loading="lazy" width="1650" height="2200" />
            </picture>
        </div>
    </div>
    <div class="hero-grid-lines" data-parallax="0.22" aria-hidden="true"></div>

    <div class="hero-inner wrap" data-parallax="0.04">
        <h1>
            <span id="heroTypewriter" data-typewriter='["Forer plus profond, avec une précision absolue.","Un leader du forage et des services.","L’expertise congolaise du forage pétrolier."]'></span><span class="hero-typewriter-cursor" aria-hidden="true"></span>
        </h1>
        <p class="hero-sub">
            Société de Forages Pétroliers · l'expertise congolaise du forage, de la complétion
            et du work over. Des opérations maîtrisées, sûres et performantes, au cœur du bassin pétrolier.
        </p>
        <div class="hero-cta">
            <a href="{{ route('metiers.index') }}" class="btn btn-primary">Découvrir nos métiers <i class="hgi-stroke hgi-arrow-right-01"></i></a>
            <a href="#contact" class="btn btn-ghost-light">Nous contacter</a>
        </div>

        <div class="hero-stats">
            <div class="hs"><b data-count="{{ now()->year - 2011 }}" data-suffix="+">0</b><span>Années d'expérience</span></div>
            <div class="hs"><b data-count="2">0</b><span>Rigs de forage</span></div>
            <div class="hs"><b>24<i>/</i>7</b><span>Opérations continues</span></div>
            <div class="hs"><b data-count="0" data-literal="HSE">HSE</b><span>Priorité absolue</span></div>
        </div>
    </div>

    <svg class="hero-notch" viewBox="0 0 1200 80" preserveAspectRatio="none" aria-hidden="true">
        <path d="M0,0 L0,0 L600,70 L1200,0 L1200,0 L1200,80 L0,80 Z" fill="#fff" />
    </svg>

    <div class="hero-scroll" aria-hidden="true">Défiler <span class="bar"></span></div>
</section>
