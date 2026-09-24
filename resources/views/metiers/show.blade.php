@extends('layouts.app', [
    'title' => $trade->title.' · SFP · Société de Forages Pétroliers',
    'description' => $trade->description,
])

@section('content')
    @include('partials.page-head', [
        'image' => 'rig03-unit',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Métiers', 'url' => route('metiers.index')],
            ['label' => $trade->title, 'url' => null],
        ],
        'kicker' => 'Nos métiers',
        'title' => $trade->title,
        'lead' => $trade->description,
    ])

    <article class="section">
        <div class="wrap">
            <div class="article">
                @if ($trade->body_html)
                    <div>{!! $trade->body_html !!}</div>
                @else
                    <p class="lead">{{ $trade->description }}</p>
                @endif

                <div class="rule mt-6 mb-4"></div>
                <a href="{{ route('metiers.index') }}" class="link-arrow"><i class="hgi-stroke hgi-arrow-left-01"></i> Tous les métiers</a>
            </div>
        </div>
    </article>

    @if ($more->isNotEmpty())
        <section class="section bg-industrial">
            <div class="wrap">
                <div class="sec-head mb-4">
                    <span class="kicker" data-index="++">À découvrir aussi</span>
                    <h2 class="title-lg">D'autres métiers de la SFP</h2>
                </div>
                <div class="trade-grid stagger">
                    @foreach ($more as $item)
                        <a href="{{ route('metiers.show', $item) }}" class="trade">
                            <div class="ico"><i class="hgi-stroke {{ $item->icon }}"></i></div>
                            <h3>{{ $item->title }}</h3>
                            <p>{{ $item->description }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="section-tight bg-charcoal noise section-photo careers-cta">
        <div class="wrap">
            <div class="careers-cta-inner reveal">
                <div>
                    <span class="kicker on-dark" data-index="02">Rejoignez-nous</span>
                    <h2 class="title-xl on-dark">Envie de mettre votre expertise au service du forage ?</h2>
                    <p class="lead mt-2">Découvrez nos offres d'emploi et rejoignez une équipe d'excellence au service de l'énergie congolaise.</p>
                </div>
                <div class="careers-cta-actions">
                    <a href="{{ route('carrieres.index') }}" class="btn btn-primary">Voir les offres d'emploi <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                </div>
            </div>
        </div>
    </section>
@endsection
