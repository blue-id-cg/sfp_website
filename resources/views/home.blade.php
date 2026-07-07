@extends('layouts.app', [
    'title' => 'SFP · Société de Forages Pétroliers | Forage, complétion & work over au Congo',
    'description' => "Société de Forages Pétroliers (SFP), filiale du groupe SNPC. Expertise congolaise du forage pétrolier, de la complétion et du work over : sécurité, performance et excellence opérationnelle.",
])

@section('splash')
    @include('partials.splash')
@endsection

@section('scrollspy')
    @include('partials.scrollspy')
@endsection

@section('content')
    @include('home.hero')
    @include('home.about')
    @include('home.activities')
    @include('home.services')
    @include('home.technology')
    @include('home.hse')
    @include('home.equipment')
    @include('home.gallery')
    @include('home.realisations')
    @include('home.actualites-teaser', ['actualites' => $actualites])
    @include('home.careers')
    @include('home.contact')
@endsection
