@php
    $homeUrl = request()->routeIs('home') ? '' : route('home');
@endphp

<!-- ===== FOOTER ===== -->
<footer class="footer noise">
    <div class="wrap">
        <div class="footer-top">
            <div class="footer-brand">
                <img src="{{ asset('images/logo-inverse.png') }}" alt="SFP · Société de Forages Pétroliers" class="footer-logo" />
                <p>{{ __("Société de Forages Pétroliers · expertise congolaise du forage, de la complétion et du work over. Filiale du groupe SNPC, au service de l'énergie et du développement du pays.") }}</p>
            </div>

            <div class="footer-col">
                <h5><span class="tick">//</span> {{ __('Entreprise') }}</h5>
                <div class="footer-links">
                    <a href="{{ route('about.index') }}">{{ __('À propos') }}</a>
                    <a href="{{ route('metiers.index') }}">{{ __('Nos métiers') }}</a>
                    <a href="{{ route('equipements.index') }}">{{ __('Équipements') }}</a>
                    <a href="{{ $homeUrl }}#realisations">{{ __('Nos réalisations') }}</a>
                </div>
            </div>

            <div class="footer-col">
                <h5><span class="tick">//</span> {{ __('Ressources') }}</h5>
                <div class="footer-links">
                    <a href="{{ route('hse.index') }}">{{ __('Politique HSE') }}</a>
                    <a href="{{ route('galerie.index') }}">{{ __('Galerie') }}</a>
                    <a href="{{ route('actualites.index') }}">{{ __('Actualités') }}</a>
                    <a href="{{ route('carrieres.index') }}">{{ __('Carrières') }}</a>
                </div>
            </div>

            <div class="footer-col">
                <h5><span class="tick">//</span> {{ __('Restons en contact') }}</h5>
                <div class="footer-links">
                    <a href="https://www.google.com/maps/search/?api=1&query=6V45%2BH3F+Pointe-Noire,+Congo" target="_blank" rel="noopener"><i class="hgi-stroke hgi-location-01"></i>&nbsp; {{ __('Pointe-Noire, Congo') }}</a>
                    <a href="tel:{{ preg_replace('/\s+/', '', $settings->contact_phone ?? '+242065870728') }}"><i class="hgi-stroke hgi-call"></i>&nbsp; {{ $settings->contact_phone ?? '+242 06 587 07 28' }}</a>
                    <a href="mailto:{{ $settings->contact_email ?? 'contact@snpc-sfp.net' }}"><i class="hgi-stroke hgi-mail-01"></i>&nbsp; {{ $settings->contact_email ?? 'contact@snpc-sfp.net' }}</a>
                </div>
            </div>
        </div>

        <div class="footer-connect">
            <div class="socials">
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a>
            </div>
            <div class="footer-newsletter">
                <form class="newsletter" data-newsletter novalidate>
                    <input type="email" placeholder="{{ __('Votre adresse e-mail') }}" aria-label="{{ __('Adresse e-mail') }}" required />
                    <button type="submit" aria-label="{{ __("S'abonner à la newsletter") }}"><i class="hgi-stroke hgi-arrow-right-01"></i></button>
                </form>
                <p class="form-note" data-newsletter-msg></p>
            </div>
        </div>

        <div class="footer-bottom">
            <div>&copy; <span data-year>{{ now()->year }}</span> {{ __('SFP · Société Anonyme au capital de 100 000 000 Francs CFA. Tous droits réservés.') }}</div>
            <div class="legal">
                <a href="{{ route('legal.mentions') }}">{{ __('Mentions légales') }}</a>
                <a href="{{ route('legal.privacy') }}">{{ __('Politique de confidentialité') }}</a>
                <a href="{{ route('legal.cookies') }}">{{ __('Cookies') }}</a>
            </div>
        </div>
    </div>
</footer>
