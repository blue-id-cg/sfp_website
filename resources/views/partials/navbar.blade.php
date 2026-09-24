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
        <a href="{{ route('home') }}" class="nav-link @if(request()->routeIs('home')) active @endif" data-nav="accueil">{{ __('Accueil') }}</a>
        <a href="{{ route('about.index') }}" class="nav-link @if(request()->routeIs('about.*')) active @endif" data-nav="entreprise">{{ __('Entreprise') }}</a>
        <a href="{{ route('metiers.index') }}" class="nav-link @if(request()->routeIs('metiers.*')) active @endif" data-nav="metiers">{{ __('Métiers') }}</a>
        <a href="{{ route('hse.index') }}" class="nav-link @if(request()->routeIs('hse.*')) active @endif" data-nav="hse">HSE</a>
        <a href="{{ route('equipements.index') }}" class="nav-link @if(request()->routeIs('equipements.*')) active @endif" data-nav="equipements">{{ __('Équipements') }}</a>
        <a href="{{ route('galerie.index') }}" class="nav-link @if(request()->routeIs('galerie.*')) active @endif" data-nav="galerie">{{ __('Galerie') }}</a>
        <a href="{{ route('actualites.index') }}" class="nav-link @if(request()->routeIs('actualites.*')) active @endif" data-nav="actualites">{{ __('Actualités') }}</a>
        <a href="{{ route('carrieres.index') }}" class="nav-link @if(request()->routeIs('carrieres.*') || request()->routeIs('offres.*')) active @endif" data-nav="carrieres">{{ __('Carrières') }}</a>
        @include('partials.language-switcher')
        <a href="{{ $homeUrl }}#contact" class="btn btn-primary btn-sm nav-cta">{{ __('Nous contacter') }}</a>
    </div>

    <button type="button" class="nav-burger" id="burger" aria-label="{{ __('Ouvrir le menu') }}" aria-expanded="false" aria-controls="mobileMenu">
        <i class="hgi-stroke hgi-menu-01"></i>
    </button>
</nav>
