@extends('layouts.app', [
    'title' => $article->title.' · SFP · Société de Forages Pétroliers',
    'description' => $article->excerpt,
])

@section('content')
    @include('partials.page-head', [
        'imageUrl' => $article->image_url,
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Actualités', 'url' => route('actualites.index')],
            ['label' => $article->category, 'url' => null],
        ],
        'kicker' => $article->category,
        'title' => $article->title,
        'lead' => $article->date_label,
    ])

    <article class="section">
        <div class="wrap">
            <div class="article">
                <p class="lead">{{ $article->excerpt }}</p>
                <div class="rule mt-3 mb-4"></div>
                <div>{!! $article->body_html !!}</div>

                <div class="rule mt-6 mb-4"></div>
                <a href="{{ route('actualites.index') }}" class="link-arrow"><i class="hgi-stroke hgi-arrow-left-01"></i> Toutes les actualités</a>
            </div>
        </div>
    </article>

    @if ($more->isNotEmpty())
        <section class="section bg-industrial">
            <div class="wrap">
                <div class="sec-head mb-4">
                    <span class="kicker" data-index="++">À lire aussi</span>
                    <h2 class="title-lg">D'autres actualités</h2>
                </div>
                <div class="news-grid">
                    @foreach ($more as $item)
                        <article class="news-card">
                            <div class="thumb">
                                <span class="pill cat">{{ $item->category }}</span>
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy" />
                            </div>
                            <div class="body">
                                <span class="date">{{ $item->date_label }}</span>
                                <h3>{{ $item->title }}</h3>
                                <p>{{ $item->excerpt }}</p>
                                <a href="{{ route('actualites.show', $item) }}" class="link-arrow">Lire l'article <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
