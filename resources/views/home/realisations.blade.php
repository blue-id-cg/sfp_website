<!-- ===== RÉALISATIONS ===== -->
<section id="realisations" class="section">
    @include('partials.strata-divider', ['color' => '#fff'])
    <span class="ghost-index" aria-hidden="true">07</span>
    <div class="wrap">
        <div class="sec-head-split mb-4">
            <div class="reveal">
                <span class="kicker" data-index="07">{{ $page->get('realisations.kicker', 'Nos réalisations') }}</span>
                <h2 class="title-xl">{{ $page->get('realisations.title', 'Des opérations menées avec exigence') }}</h2>
            </div>
            <div class="r reveal">
                <p class="lead">{{ $page->get('realisations.lead', "Un aperçu des opérations à l'actif de la SFP depuis le démarrage de ses activités en 2011.") }}</p>
            </div>
        </div>

        <div class="projects stagger">
            @foreach ($realisations as $realisation)
                <article class="project" data-lightbox data-full="{{ $realisation->image_url }}">
                    <picture>
                        @if ($realisation->image && ! str_contains($realisation->image, '/'))
                            <source type="image/webp" srcset="{{ asset('images/opt/'.$realisation->image.'.webp') }}" />
                        @endif
                        <img src="{{ $realisation->image_url }}" alt="{{ $realisation->title }}" loading="lazy" />
                    </picture>
                    <div class="project-top">
                        <span class="op-index">Opération {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="op-stamp"><i class="fa-solid fa-circle-check"></i> Réalisé</span>
                    </div>
                    <div class="meta">
                        @if ($realisation->category)
                            <span class="pill pill-y">{{ $realisation->category }}</span>
                        @endif
                        <h3>{{ $realisation->title }}</h3>
                        <p>{{ $realisation->description }}</p>
                        @if ($realisation->facts)
                            <ul class="op-facts">
                                @foreach ($realisation->facts as $fact)
                                    <li><i class="{{ $fact['icon'] ?? 'fa-solid fa-circle' }}"></i> {{ $fact['text'] }}</li>
                                @endforeach
                            </ul>
                        @endif
                        @if ($realisation->tags)
                            <div class="op-tags">
                                @foreach ($realisation->tags as $tag)
                                    <span>{{ $tag }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <span class="op-cta">Voir l'opération <i class="hgi-stroke hgi-arrow-right-01"></i></span>
                </article>
            @endforeach
        </div>
    </div>
</section>
