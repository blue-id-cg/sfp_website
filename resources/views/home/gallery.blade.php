<!-- ===== GALERIE ===== -->
<section id="galerie" class="section bg-charcoal noise">
    <div class="wrap">
        <div class="sec-head center reveal">
            <span class="kicker on-dark" data-index="07">Galerie</span>
            <h2 class="title-xl on-dark">Le forage, en images</h2>
            <p class="lead mx-auto maxw-md">Plateformes, équipements, équipes sur le terrain : des images qui racontent le quotidien et le savoir-faire de la SFP.</p>
        </div>

        @php
            $shots = [
                ['full' => 'rig-tall', 'thumb' => 'rig-tall-m', 'alt' => 'Appareil de forage SFP en opération', 'caption' => 'Appareil de forage'],
                ['full' => 'crew-platform', 'thumb' => 'crew-platform-m', 'alt' => 'Équipes SFP sur le plancher de forage', 'caption' => 'Équipes sur le terrain'],
                ['full' => 'rig-flag', 'thumb' => 'rig-flag', 'alt' => 'Mât de forage et drapeau du Congo', 'caption' => 'Mât de forage'],
                ['full' => 'leadership', 'thumb' => 'leadership-m', 'alt' => 'Direction et partenaires de la SFP', 'caption' => 'Direction & partenaires'],
                ['full' => 'crew-women', 'thumb' => 'crew-women-m', 'alt' => 'Collaboratrices SFP sur un site de forage', 'caption' => 'Sur le site'],
                ['full' => 'rig03-unit', 'thumb' => 'rig03-unit-m', 'alt' => 'Unité mobile de forage RIG #03', 'caption' => 'Unité RIG&nbsp;#03'],
                ['full' => 'mobilization', 'thumb' => 'mobilization', 'alt' => "Mobilisation d'un appareil de forage à la grue", 'caption' => 'Mobilisation'],
                ['full' => 'crew-walking', 'thumb' => 'crew-walking', 'alt' => 'Collaborateurs SFP en tenue de sécurité', 'caption' => 'Culture sécurité'],
                ['full' => 'crew-mudpumps', 'thumb' => 'crew-mudpumps-m', 'alt' => 'Suivi des opérations de forage', 'caption' => 'Suivi des opérations'],
            ];
        @endphp

        <div class="gallery reveal mt-6" data-gallery>
            @foreach ($shots as $shot)
                <figure class="shot" data-lightbox data-full="{{ asset('images/opt/' . $shot['full'] . '.jpg') }}">
                    <picture>
                        <source type="image/webp" srcset="{{ asset('images/opt/' . $shot['thumb'] . '.webp') }}" />
                        <img src="{{ asset('images/opt/' . $shot['thumb'] . '.jpg') }}" alt="{{ $shot['alt'] }}" loading="lazy" />
                    </picture>
                    <figcaption>{!! $shot['caption'] !!}</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
