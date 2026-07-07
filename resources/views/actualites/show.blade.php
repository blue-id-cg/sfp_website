@extends('layouts.app', [
    'title' => $article['title'].' · SFP · Société de Forages Pétroliers',
    'description' => $article['excerpt'],
])

@section('content')
    @include('partials.page-head', [
        'image' => $article['image'],
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Actualités', 'url' => route('actualites.index')],
            ['label' => $article['category'], 'url' => null],
        ],
        'kicker' => $article['category'],
        'title' => $article['title'],
        'lead' => $article['date'],
    ])

    <article class="section">
        <div class="wrap">
            <div class="article">
                <p class="lead">{{ $article['excerpt'] }}</p>
                <div class="rule mt-3 mb-4"></div>
                <div>{!! $article['body'] !!}</div>

                <div class="rule mt-6 mb-4"></div>
                <a href="{{ route('actualites.index') }}" class="link-arrow"><i class="fas fa-arrow-left"></i> Toutes les actualités</a>
            </div>
        </div>
    </article>

    @if (count($more))
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
                                <span class="pill cat">{{ $item['category'] }}</span>
                                <img src="{{ asset('images/opt/' . $item['image'] . '.jpg') }}" alt="{{ $item['title'] }}" loading="lazy" />
                            </div>
                            <div class="body">
                                <span class="date">{{ $item['date'] }}</span>
                                <h3>{{ $item['title'] }}</h3>
                                <p>{{ $item['excerpt'] }}</p>
                                <a href="{{ route('actualites.show', $item['slug']) }}" class="link-arrow">Lire l'article <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
