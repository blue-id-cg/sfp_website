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
            <div class="sec-head-split mb-4">
                <div class="reveal">
                    <span class="kicker" data-index="01">{{ $totalImages }} photo{{ $totalImages > 1 ? 's' : '' }}</span>
                    <h2 class="title-md">Le quotidien de nos opérations</h2>
                </div>
                <div class="r reveal">
                    <p class="lead">Cliquez sur une photo pour l'agrandir et naviguer dans la galerie complète.</p>
                </div>
            </div>

            @if ($images->isEmpty())
                <div class="rounded-xl border border-dashed border-gray-200 py-16 text-center text-gray-500">
                    <i class="hgi-stroke hgi-image-02 mb-3 block text-3xl text-gray-300"></i>
                    Aucune photo n'a encore été publiée.
                </div>
            @else
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
            @endif
        </div>
    </section>
@endsection
