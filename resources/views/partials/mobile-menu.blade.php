@php
    $homeUrl = request()->routeIs('home') ? '' : route('home');
@endphp

<!-- ===== MENU MOBILE ===== -->
<div id="mobileMenu" class="mobile-menu" aria-hidden="true">
    <button type="button" class="mm-close" id="mmClose" aria-label="Fermer le menu"><i class="fas fa-times"></i></button>
    <nav aria-label="Navigation mobile">
        <a href="{{ route('home') }}" class="mm-link"><span>Accueil</span><span class="idx">01</span></a>
        <a href="{{ $homeUrl }}#entreprise" class="mm-link"><span>Entreprise</span><span class="idx">02</span></a>
        <a href="{{ $homeUrl }}#metiers" class="mm-link"><span>Métiers</span><span class="idx">03</span></a>
        <a href="{{ $homeUrl }}#hse" class="mm-link"><span>HSE</span><span class="idx">04</span></a>
        <a href="{{ $homeUrl }}#equipements" class="mm-link"><span>Équipements</span><span class="idx">05</span></a>
        <a href="{{ route('actualites.index') }}" class="mm-link"><span>Actualités</span><span class="idx">06</span></a>
        <a href="{{ route('carrieres.index') }}" class="mm-link"><span>Carrières</span><span class="idx">07</span></a>
        <a href="{{ $homeUrl }}#contact" class="mm-link"><span>Contact</span><span class="idx">08</span></a>
    </nav>
    <div class="mm-foot">
        <div>Avenue du Général de Gaulle · Pointe-Noire, Congo</div>
        <a href="{{ $homeUrl }}#contact" class="btn btn-primary">Démarrer un projet <i class="fas fa-arrow-right"></i></a>
    </div>
</div>
