@extends('layouts.app', [
    'title' => 'Galerie · SFP · Société de Forages Pétroliers',
    'description' => 'Plateformes, équipements, équipes sur le terrain : découvrez en images le quotidien et le savoir-faire de la SFP.',
])

@section('content')
    @include('partials.page-head', [
        'image' => 'rig-tall',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Galerie', 'url' => null],
        ],
        'kicker' => 'Galerie',
        'title' => 'Le forage, en images',
        'lead' => 'Plateformes, équipements, équipes sur le terrain : des images qui racontent le quotidien et le savoir-faire de la SFP.',
    ])

    <section class="section">
        <div class="wrap">
            <div class="core-grid reveal">
                @foreach ($images as $image)
                    <figure class="core-sample" data-lightbox data-full="{{ $image->image_url }}">
                        <img src="{{ $image->image_url }}" alt="{{ $image->title }}" loading="lazy" />
                        <figcaption>{{ $image->caption }}</figcaption>
                    </figure>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $images->links() }}
            </div>
        </div>
    </section>
@endsection
