@extends('layouts.app', [
    'title' => $offre->title.' · SFP · Société de Forages Pétroliers',
    'description' => $offre->summary,
])

@section('content')
    <header class="page-head">
        <img src="{{ asset('images/opt/rig03-unit.jpg') }}" alt="" aria-hidden="true" data-parallax="0.18" />
        <div class="wrap">
            <nav class="breadcrumb" aria-label="Fil d'Ariane">
                <a href="{{ route('home') }}">Accueil</a> <i class="fas fa-chevron-right"></i>
                <a href="{{ route('carrieres.index') }}">Carrières</a> <i class="fas fa-chevron-right"></i>
                <span>{{ $offre->title }}</span>
            </nav>
            <h1>{{ $offre->title }}</h1>
            <div class="job-tags mt-3">
                @foreach ($offre->tags ?? [] as $tag)
                    <span class="job-tag"><i class="fas fa-tag"></i> {{ $tag }}</span>
                @endforeach
            </div>
        </div>
    </header>

    <section class="section">
        <div class="wrap">
            <div class="split items-start">
                <div class="reveal-left">
                    <p class="lead">{{ $offre->summary }}</p>

                    <div class="mt-5">
                        <h2 class="title-md mb-3">Missions</h2>
                        <ul class="dotted article">
                            @foreach ($offre->missions ?? [] as $mission)
                                <li>{{ $mission }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-5">
                        <h2 class="title-md mb-3">Profil recherché</h2>
                        <ul class="dotted article">
                            @foreach ($offre->profile ?? [] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="rule mt-6 mb-4"></div>
                    <a href="{{ route('carrieres.index') }}#offres" class="link-arrow"><i class="fas fa-arrow-left"></i> Toutes les offres</a>
                </div>

                <aside class="reveal-right">
                    @include('partials.application-form', ['poste' => $offre->title])
                </aside>
            </div>
        </div>
    </section>
@endsection
