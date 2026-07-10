<!-- ===== ENTREPRISE / À PROPOS ===== -->
<section id="entreprise" class="section entreprise">
    <span class="ghost-index" aria-hidden="true">01</span>
    <div class="wrap">
        <!-- En-tête éditorial : titre à gauche, accroche + chiffres à droite -->
        <div class="ent-head reveal">
            <div class="ent-head-lead">
                <span class="kicker" data-index="01">L'entreprise</span>
                <h2 class="title-xl">Une expertise <span class="mark accent">congolaise</span> au cœur de l'industrie pétrolière</h2>
            </div>
            <div class="ent-head-aside">
                <p class="lead">
                    Depuis 2010, la <strong>SFP</strong> conçoit et opère des forages onshore pour les acteurs
                    majeurs du secteur pétrolier congolais — avec un principe non négociable : <strong>zéro incident</strong>.
                </p>
                <dl class="ent-stats">
                    <div class="ent-stat">
                        <dt class="ent-stat-num"><span data-count="15" data-suffix="+">0</span></dt>
                        <dd class="ent-stat-label">Années d'expertise</dd>
                    </div>
                    <div class="ent-stat">
                        <dt class="ent-stat-num"><span data-count="0">0</span></dt>
                        <dd class="ent-stat-label">Incident enregistré</dd>
                    </div>
                    <div class="ent-stat">
                        <dt class="ent-stat-num"><span data-count="100" data-suffix=" %">0</span></dt>
                        <dd class="ent-stat-label">Filiale SNPC</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="split items-start ent-body">
            <!-- Visuel (colonne gauche, collant au scroll) -->
            <div class="ent-media reveal-left">
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

            <!-- Récit « carotte de forage » (colonne droite) -->
            <div class="ent-story reveal-right">
                <p class="text-body ent-mission">
                    Notre mission : fournir des prestations de haute qualité tout au long du cycle de vie des puits,
                    en garantissant la sécurité de nos équipes, la maîtrise des risques industriels et le respect
                    des normes internationales.
                </p>

                <ol class="core-log stagger" aria-label="Étapes clés de la SFP">
                    <li class="core-step">
                        <span class="core-node" aria-hidden="true"></span>
                        <span class="core-depth">2010 · Création</span>
                        <h3 class="core-title">Naissance de la SFP</h3>
                        <p class="core-desc">Fondation de la société, filiale à 100 % du groupe SNPC.</p>
                    </li>
                    <li class="core-step">
                        <span class="core-node" aria-hidden="true"></span>
                        <span class="core-depth">Sept. 2011 · Mise en service</span>
                        <h3 class="core-title">Premières opérations</h3>
                        <p class="core-desc">Démarrage sur le premier marché MKB (Mengo-Kudji-Bindi) attribué à la SNPC.</p>
                    </li>
                    <li class="core-step is-current">
                        <span class="core-node" aria-hidden="true"></span>
                        <span class="core-depth">Aujourd'hui · En opération</span>
                        <h3 class="core-title">Plusieurs puits forés sans incident</h3>
                        <p class="core-desc">Du forage à la maintenance, au service des acteurs majeurs du secteur pétrolier au Congo.</p>
                    </li>
                </ol>

                <div class="ent-values">
                    <div class="ent-value">
                        <span class="ico"><i class="hgi-stroke hgi-target-01"></i></span>
                        <h4>Excellence opérationnelle</h4>
                        <p>Des standards élevés, une amélioration continue et une exigence de résultat sur le terrain.</p>
                    </div>
                    <div class="ent-value">
                        <span class="ico"><i class="hgi-stroke hgi-agreement-01"></i></span>
                        <h4>Fiabilité &amp; transparence</h4>
                        <p>Un partenaire de confiance pour des projets pétroliers complexes et exigeants.</p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('about.index') }}" class="btn btn-primary">En savoir plus sur la SFP <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
