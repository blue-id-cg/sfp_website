<!-- ===== HERO ===== -->
<section id="accueil" class="hero">
    <div class="hero-media" data-parallax="0.08">
        <picture>
            <source type="image/webp" srcset="{{ asset('images/opt/rig-tall.webp') }}" />
            <img src="{{ asset('images/opt/rig-tall.jpg') }}" alt="Appareil de forage SFP en opération sur un site pétrolier au Congo" fetchpriority="high" width="1650" height="2200" />
        </picture>
    </div>
    <div class="hero-grid-lines" aria-hidden="true"></div>

    <div class="hero-inner wrap">
        <span class="hero-eyebrow"><span class="dot"></span> Congo · Groupe SNPC</span>
        <h1>
            Forer plus profond,<br />
            avec une <em>précision</em> absolue.
        </h1>
        <p class="hero-sub">
            Société de Forages Pétroliers · l'expertise congolaise du forage, de la complétion
            et du work over. Des opérations maîtrisées, sûres et performantes, au cœur du bassin pétrolier.
        </p>
        <p class="hero-tagline">Le forage au Congo, c'est nous !</p>
        <div class="hero-cta">
            <a href="#metiers" class="btn btn-primary">Découvrir nos métiers <i class="fas fa-arrow-right"></i></a>
            <a href="#contact" class="btn btn-ghost-light">Nous contacter</a>
        </div>

        <div class="hero-stats">
            <div class="hs"><b data-count="{{ now()->year - 2011 }}" data-suffix="+">0</b><span>Années d'expérience</span></div>
            <div class="hs"><b data-count="2">0</b><span>Rigs de forage</span></div>
            <div class="hs"><b>24<i>/</i>7</b><span>Opérations continues</span></div>
            <div class="hs"><b data-count="0" data-literal="HSE">HSE</b><span>Priorité absolue</span></div>
        </div>
    </div>

    <div class="hero-scroll" aria-hidden="true">Défiler <span class="bar"></span></div>
</section>
