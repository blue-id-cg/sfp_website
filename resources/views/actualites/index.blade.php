@extends('layouts.app', [
    'title' => 'Actualités · SFP · Société de Forages Pétroliers',
    'description' => "Toute l'actualité de la Société de Forages Pétroliers (SFP) : opérations, sécurité HSE, innovation, ressources humaines et vie de l'entreprise.",
])

@section('content')
    @include('partials.page-head', [
        'image' => 'crew-platform',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Actualités', 'url' => null],
        ],
        'kicker' => 'Newsroom',
        'kickerIndex' => '//',
        'title' => 'Actualités de la SFP',
        'lead' => "Opérations, sécurité, innovation et vie de l'entreprise : suivez les temps forts de la Société de Forages Pétroliers.",
    ])

    <section class="section">
        <div class="wrap">
            <div class="news-grid">
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
@endsection
