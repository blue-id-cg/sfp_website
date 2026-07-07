@php
    $homeUrl = request()->routeIs('home') ? '' : route('home');
@endphp

<!-- ===== FOOTER ===== -->
<footer class="footer noise">
    <div class="wrap">
        <div class="footer-top">
            <div class="footer-brand">
                <img src="{{ asset('images/logo2.png') }}" alt="SFP · Société de Forages Pétroliers" />
                <p>Société de Forages Pétroliers · expertise congolaise du forage, de la complétion et du work over. Filiale du groupe SNPC, au service de l'énergie et du développement du pays.</p>
                <div class="socials">
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" aria-label="X"><i class="fab fa-x-twitter"></i></a>
                </div>
            </div>

            <div>
                <h5>Entreprise</h5>
                <div class="footer-links">
                    <a href="{{ $homeUrl }}#entreprise">À propos</a>
                    <a href="{{ $homeUrl }}#metiers">Nos métiers</a>
                    <a href="{{ $homeUrl }}#innovation">Innovation</a>
                    <a href="{{ $homeUrl }}#realisations">Nos réalisations</a>
                </div>
            </div>

            <div>
                <h5>Ressources</h5>
                <div class="footer-links">
                    <a href="{{ $homeUrl }}#hse">Politique HSE</a>
                    <a href="{{ route('actualites.index') }}">Actualités</a>
                    <a href="{{ route('carrieres.index') }}">Carrières</a>
                    <a href="{{ $homeUrl }}#contact">Contact</a>
                </div>
            </div>

            <div>
                <h5>Restons en contact</h5>
                <div class="footer-links">
                    <a href="https://maps.google.com/?q=Pointe-Noire,Congo" target="_blank" rel="noopener"><i class="fas fa-location-dot"></i>&nbsp; Pointe-Noire, Congo</a>
                    <a href="tel:+242065870728"><i class="fas fa-phone"></i>&nbsp; +242 06 587 07 28</a>
                    <a href="mailto:contact@snpc-sfp.net"><i class="fas fa-envelope"></i>&nbsp; contact@snpc-sfp.net</a>
                </div>
                <form class="newsletter" data-newsletter novalidate>
                    <input type="email" placeholder="Votre adresse e-mail" aria-label="Adresse e-mail" required />
                    <button type="submit" aria-label="S'abonner à la newsletter"><i class="fas fa-arrow-right"></i></button>
                </form>
                <p class="form-note" data-newsletter-msg></p>
            </div>
        </div>

        <div class="footer-bottom">
            <div>&copy; <span data-year>{{ now()->year }}</span> SFP · Société Anonyme au capital de 100 000 000 Francs CFA. Tous droits réservés.</div>
            <div class="legal">
                <a href="#">Mentions légales</a>
                <a href="#">Politique de confidentialité</a>
                <a href="#">Cookies</a>
            </div>
        </div>
    </div>
</footer>
