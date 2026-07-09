@extends('layouts.app', [
    'title' => 'Erreur serveur · SFP · Société de Forages Pétroliers',
    'description' => "Une erreur inattendue est survenue.",
])

@section('content')
    <section class="section bg-charcoal noise" style="min-height: 70vh; display: flex; align-items: center;">
        <div class="wrap text-center">
            <span class="kicker on-dark mx-auto" data-index="500" style="justify-content: center;">Erreur</span>
            <h1 class="title-xl on-dark">Une erreur inattendue est survenue</h1>
            <p class="lead on-dark mx-auto maxw-md mt-2">Nos équipes techniques ont été informées. Merci de réessayer dans quelques instants.</p>
            <div class="hero-cta mt-4" style="justify-content: center;">
                <a href="{{ route('home') }}" class="btn btn-primary">Retour à l'accueil <i class="hgi-stroke hgi-arrow-right-01"></i></a>
            </div>
        </div>
    </section>
@endsection
