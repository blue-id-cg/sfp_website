<!-- ===== CARRIÈRES (appel à l'action) ===== -->
<section id="carrieres-cta" class="section-tight bg-charcoal noise section-photo careers-cta">
    <div class="wrap">
        <div class="careers-cta-inner reveal">
            <div>
                <span class="kicker on-dark" data-index="09">{{ $page->get('careers.kicker', 'Carrières') }}</span>
                <h2 class="title-xl on-dark">{{ $page->get('careers.title', "Des métiers d'exigence, une équipe qui progresse") }}</h2>
                <p class="lead maxw-md mt-2">{{ $page->get('careers.lead', 'Formation continue, transmission du savoir-faire et culture de sécurité : découvrez pourquoi rejoindre la SFP, et nos postes actuellement ouverts.') }}</p>
            </div>
            <div class="careers-cta-actions">
                <a href="{{ route('carrieres.index') }}" class="btn btn-primary">Voir les opportunités <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                <a href="{{ route('carrieres.index') }}#candidature" class="btn btn-ghost-light">Candidature spontanée</a>
            </div>
        </div>
    </div>
</section>
