<!-- ===== ACTUALITÉS (aperçu) ===== -->
<section id="actualites-teaser" class="section bg-industrial">
    <div class="wrap">
        <div class="sec-head-split mb-4">
            <div class="reveal">
                <span class="kicker" data-index="09">Actualités</span>
                <h2 class="title-xl">Les temps forts<br />de la SFP</h2>
            </div>
            <div class="r reveal">
                <p class="lead">Un aperçu de nos dernières publications. Retrouvez l'ensemble de nos actualités sur la page dédiée.</p>
                <a href="{{ route('actualites.index') }}" class="link-arrow mt-3">Toutes les actualités <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <div class="news-grid reveal">
            @foreach ($actualites as $actualite)
                <article class="news-card">
                    <div class="thumb">
                        <span class="pill cat">{{ $actualite['category'] }}</span>
                        <img src="{{ asset('images/opt/' . $actualite['image'] . '.jpg') }}" alt="{{ $actualite['title'] }}" loading="lazy" />
                    </div>
                    <div class="body">
                        <span class="date">{{ $actualite['date'] }}</span>
                        <h3>{{ $actualite['title'] }}</h3>
                        <p>{{ $actualite['excerpt'] }}</p>
                        <a href="{{ route('actualites.show', $actualite['slug']) }}" class="link-arrow">Lire l'article <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
