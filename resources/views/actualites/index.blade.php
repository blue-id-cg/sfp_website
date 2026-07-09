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
            <div class="drill-log">
                @foreach ($actualites as $actualite)
                    <article class="drill-log-entry">
                        <div class="drill-log-axis">
                            <span class="drill-log-date">{{ $actualite->date_label }}</span>
                            <span class="drill-log-node"></span>
                        </div>
                        <div class="drill-log-card">
                            <div class="drill-log-thumb">
                                <img src="{{ $actualite->image_url }}" alt="{{ $actualite->title }}" loading="lazy" />
                            </div>
                            <div class="drill-log-body">
                                <span class="pill cat">{{ $actualite->category }}</span>
                                <h3>{{ $actualite->title }}</h3>
                                <p>{{ $actualite->excerpt }}</p>
                                <a href="{{ route('actualites.show', $actualite) }}" class="link-arrow">Lire l'article <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $actualites->links() }}
            </div>
        </div>
    </section>
@endsection
