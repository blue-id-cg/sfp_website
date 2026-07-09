@php
    /**
     * Jauge de profondeur : reformule la progression de scroll en mètres forés,
     * avec le nom de la page courante comme repère. Présente sur toutes les pages du site public.
     */
    $depthLabel = match (true) {
        request()->routeIs('home') => 'Accueil',
        request()->routeIs('about.*') => 'Entreprise',
        request()->routeIs('metiers.*') => 'Métiers',
        request()->routeIs('hse.*') => 'HSE',
        request()->routeIs('equipements.*') => 'Équipements',
        request()->routeIs('galerie.*') => 'Galerie',
        request()->routeIs('actualites.*') => 'Actualités',
        request()->routeIs('carrieres.*'), request()->routeIs('offres.*') => 'Carrières',
        request()->routeIs('legal.*') => 'Informations',
        default => 'Page',
    };
@endphp
<div class="depth-gauge" id="depthGauge" aria-hidden="true">
    <div class="depth-gauge-readout">
        <span class="depth-gauge-value" id="depthValue">0 m</span>
        <span class="depth-gauge-label">{{ $depthLabel }}</span>
    </div>
    <div class="depth-gauge-rail">
        <div class="depth-gauge-fill" id="depthFill"></div>
        <span class="depth-gauge-bit" id="depthBit"></span>
    </div>
</div>
