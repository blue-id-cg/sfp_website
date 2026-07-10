<!-- ===== ACTUALITÉS (aperçu) ===== -->
<section id="actualites-teaser" class="section bg-industrial">
    <div class="wrap">
        <div class="sec-head-split mb-4">
            <div class="reveal">
                <span class="kicker" data-index="08">Actualités</span>
                <h2 class="title-xl">Les temps forts<br />de la SFP</h2>
            </div>
            <div class="r reveal">
                <p class="lead">Un aperçu de nos dernières publications. Retrouvez l'ensemble de nos actualités sur la page dédiée.</p>
                <a href="{{ route('actualites.index') }}" class="link-arrow mt-3">Toutes les actualités <i class="hgi-stroke hgi-arrow-right-01"></i></a>
            </div>
        </div>

        @php
            $featured = $actualites->first();
            $rest = $actualites->slice(1);
        @endphp

        @if ($featured)
            <div class="highlights">
                <!-- Temps fort principal -->
                <article class="hl-feature reveal-left">
                    <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" loading="lazy" />
                    <span class="hl-flag"><i class="fa-solid fa-star"></i> À la une</span>
                    <span class="pill cat hl-cat">{{ $featured->category }}</span>
                    <div class="hl-feature-body">
                        <span class="hl-date">{{ $featured->date_label }}</span>
                        <h3><a href="{{ route('actualites.show', $featured) }}" class="hl-stretch">{{ $featured->title }}</a></h3>
                        <p>{{ $featured->excerpt }}</p>
                        <span class="op-cta hl-cta">Lire l'article <i class="hgi-stroke hgi-arrow-right-01"></i></span>
                    </div>
                </article>

                <!-- Autres temps forts -->
                <div class="hl-list reveal-right">
                    @foreach ($rest as $actualite)
                        <article class="hl-item">
                            <div class="hl-item-thumb">
                                <img src="{{ $actualite->image_url }}" alt="{{ $actualite->title }}" loading="lazy" />
                            </div>
                            <div class="hl-item-body">
                                <span class="hl-item-tags">
                                    <span class="hl-item-cat">{{ $actualite->category }}</span>
                                    <span class="hl-date">{{ $actualite->date_label }}</span>
                                </span>
                                <h3><a href="{{ route('actualites.show', $actualite) }}" class="hl-stretch">{{ $actualite->title }}</a></h3>
                                <span class="hl-item-more">Lire <i class="hgi-stroke hgi-arrow-right-01"></i></span>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
