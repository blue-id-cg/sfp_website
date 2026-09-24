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
                    <article class="drill-log-entry reveal">
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
                                <a href="{{ route('actualites.show', $actualite) }}" class="link-arrow">Lire l'article <i class="hgi-stroke hgi-arrow-right-01"></i></a>
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

    @if ($industryNews->isNotEmpty())
        <section class="section-tight bg-industrial">
            <div class="wrap">
                <div class="sec-head mb-4">
                    <span class="kicker" data-index="++">Veille sectorielle</span>
                    <h2 class="title-lg">Ailleurs, dans l'actualité du secteur</h2>
                    <p class="lead mt-2">Une sélection de titres externes sur l'actualité du forage et de l'énergie, fournie à titre informatif — hors publications de la SFP.</p>
                </div>
                <div class="watch-list">
                    @foreach ($industryNews as $item)
                        <a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferrer" class="watch-item">
                            @if ($item['image'])
                                <div class="watch-thumb">
                                    <img src="{{ $item['image'] }}" alt="" loading="lazy" />
                                </div>
                            @endif
                            <div class="watch-body">
                                <span class="watch-title">{{ $item['title'] }}</span>
                                <span class="watch-meta">
                                    <span class="watch-source">{{ $item['source'] }}</span>
                                    @if ($item['published_at'])
                                        <span class="watch-date">{{ $item['published_at']->translatedFormat('d F Y') }}</span>
                                    @endif
                                </span>
                            </div>
                            <i class="hgi-stroke hgi-arrow-right-01"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
