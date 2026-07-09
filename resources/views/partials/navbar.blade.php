@php
    $homeUrl = request()->routeIs('home') ? '' : route('home');
@endphp

<!-- ===== NAVBAR ===== -->
<nav id="nav" class="nav" aria-label="Navigation principale">
    <a href="{{ route('home') }}" class="nav-logo" aria-label="SFP · Accueil">
        <img src="{{ asset('images/logo-inverse.png') }}" alt="SFP" class="nav-logo-light" />
        <img src="{{ asset('images/logo2.png') }}" alt="SFP" class="nav-logo-dark" />
    </a>

    <div class="nav-menu">
        <a href="{{ route('home') }}" class="nav-link @if(request()->routeIs('home')) active @endif" data-nav="accueil">Accueil</a>
        <a href="{{ $homeUrl }}#entreprise" class="nav-link" data-nav="entreprise">Entreprise</a>
        <a href="{{ $homeUrl }}#metiers" class="nav-link" data-nav="metiers">Métiers</a>
        <a href="{{ $homeUrl }}#hse" class="nav-link" data-nav="hse">HSE</a>
        <a href="{{ $homeUrl }}#equipements" class="nav-link" data-nav="equipements">Équipements</a>
        <a href="{{ route('galerie.index') }}" class="nav-link @if(request()->routeIs('galerie.*')) active @endif" data-nav="galerie">Galerie</a>
        <a href="{{ route('actualites.index') }}" class="nav-link @if(request()->routeIs('actualites.*')) active @endif" data-nav="actualites">Actualités</a>
        <a href="{{ route('carrieres.index') }}" class="nav-link @if(request()->routeIs('carrieres.*') || request()->routeIs('offres.*')) active @endif" data-nav="carrieres">Carrières</a>
        <a href="{{ $homeUrl }}#contact" class="btn btn-primary btn-sm nav-cta">Nous contacter</a>
    </div>

    <button type="button" class="nav-burger" id="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="mobileMenu">
        <i class="fas fa-bars"></i>
    </button>
</nav>
