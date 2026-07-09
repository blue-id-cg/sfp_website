<!-- ===== GALERIE ===== -->
<section id="galerie" class="section bg-charcoal noise">
    @include('partials.strata-divider', ['color' => 'var(--charcoal)'])
    <div class="wrap">
        <div class="sec-head center reveal">
            <span class="kicker on-dark" data-index="06">Galerie</span>
            <h2 class="title-xl on-dark">Le forage, en images</h2>
            <p class="lead mx-auto maxw-md">Plateformes, équipements, équipes sur le terrain : des images qui racontent le quotidien et le savoir-faire de la SFP.</p>
        </div>
    </div>

    <div class="core-strip-wrap reveal mt-6">
        <div class="core-strip-ruler" aria-hidden="true">
            @foreach ($galleryImages as $i => $shot)
                <span>{{ number_format(120 + $i * 210, 0, ',', ' ') }} m</span>
            @endforeach
        </div>
        <div class="core-strip" data-core-strip>
            @foreach ($galleryImages as $shot)
                <figure class="core-sample" data-lightbox data-full="{{ $shot->image_url }}">
                    <img src="{{ $shot->image_url }}" alt="{{ $shot->title }}" loading="lazy" />
                    <figcaption>{{ $shot->caption }}</figcaption>
                </figure>
            @endforeach
        </div>
    </div>

    <div class="wrap">
        <div class="center mt-6 reveal">
            <a href="{{ route('galerie.index') }}" class="btn btn-ghost">Voir plus de photos <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</section>
