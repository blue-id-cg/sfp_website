@extends('layouts.app', [
    'title' => 'Page introuvable · SFP · Société de Forages Pétroliers',
    'description' => "La page que vous recherchez n'existe pas ou plus.",
])

@section('content')
    <section class="section bg-charcoal noise" style="min-height: 70vh; display: flex; align-items: center;">
        <div class="wrap text-center">
            <span class="kicker on-dark mx-auto" data-index="404" style="justify-content: center;">Erreur</span>
            <h1 class="title-xl on-dark">Cette page n'existe pas ou plus</h1>
            <p class="lead on-dark mx-auto maxw-md mt-2">Le lien suivi est peut-être obsolète. Retrouvez nos informations à jour depuis l'accueil.</p>
            <div class="hero-cta mt-4" style="justify-content: center;">
                <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil <i class="hgi-stroke hgi-arrow-right-01"></i></a>
                <a href="{{ route('home') }}#contact" class="btn btn-ghost-light">Nous contacter</a>
            </div>
        </div>
    </section>
@endsection
