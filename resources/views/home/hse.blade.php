<!-- ===== HSE (aperçu) ===== -->
<section class="section-tight bg-charcoal noise on-dark">
    <div class="wrap">
        <div class="sec-head-split mb-4">
            <div class="reveal">
                <span class="kicker on-dark" data-index="04">{{ $page->get('hse.kicker', 'Santé · Sécurité · Environnement') }}</span>
                <h2 class="title-xl on-dark">{{ $page->get('hse.title', 'La sécurité avant la performance') }}</h2>
            </div>
            <div class="r reveal">
                <p class="lead">{{ $page->get('hse.lead', "Notre engagement pour la santé, la sécurité et l'environnement est non négociable : le fondement de notre culture d'entreprise.") }}</p>
                <a href="{{ route('hse.index') }}" class="link-arrow mt-3">Notre démarche HSE <i class="hgi-stroke hgi-arrow-right-01"></i></a>
            </div>
        </div>

        <div class="hse-metrics stagger" role="list">
            @foreach ($engagements as $metric)
                <div role="listitem"><i class="hgi-stroke {{ $metric->icon }}"></i><b>{{ $metric->title }}</b><span>{{ $metric->description }}</span></div>
            @endforeach
        </div>
    </div>
</section>
