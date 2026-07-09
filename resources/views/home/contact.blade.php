<!-- ===== CONTACT ===== -->
<section id="contact" class="section">
    @include('partials.strata-divider', ['color' => '#fff'])
    <div class="wrap">
        <div class="split contact-grid">
            <div class="reveal-left">
                <span class="kicker" data-index="10">Contact</span>
                <h2 class="title-xl">Discutons de vos <span class="mark accent">projets</span></h2>
                <p class="lead mt-3">Une question, un projet, un partenariat ? Nos équipes sont à votre écoute pour vous accompagner à chaque étape.</p>

                <div class="grid gap-md mt-5">
                    <div class="contact-item">
                        <span class="ico"><i class="fas fa-location-dot"></i></span>
                        <div><h4>Adresse</h4><p>Avenue du Général de Gaulle, B.P. 622,<br />Pointe-Noire, République du Congo</p></div>
                    </div>
                    <div class="contact-item">
                        <span class="ico"><i class="fas fa-phone"></i></span>
                        <div><h4>Téléphone</h4><a href="tel:+242065870728">+242 06 587 07 28</a></div>
                    </div>
                    <div class="contact-item">
                        <span class="ico"><i class="fas fa-envelope"></i></span>
                        <div><h4>E-mail</h4><a href="mailto:contact@snpc-sfp.net">contact@snpc-sfp.net</a></div>
                    </div>
                    <div class="contact-item">
                        <span class="ico"><i class="fas fa-briefcase"></i></span>
                        <div><h4>Recrutement</h4><a href="{{ route('carrieres.index') }}">Consulter nos offres d'emploi</a></div>
                    </div>
                </div>
            </div>

            <div class="reveal-right">
                <div class="form-card">
                    <h3 class="title-md mb-3">Envoyez-nous un message</h3>

                    @if (session('contact_sent'))
                        <div class="form-alert ok show"><i class="fas fa-circle-check"></i> <span>Merci, votre message a bien été envoyé. Nous vous répondrons rapidement.</span></div>
                        @push('scripts')
                            <script>document.getElementById('contact')?.scrollIntoView({ behavior: 'smooth', block: 'start' });</script>
                        @endpush
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" novalidate>
                        @csrf
                        <div class="field-row">
                            <div class="field">
                                <label for="c-name">Nom &amp; prénom <span class="req">*</span></label>
                                <input type="text" id="c-name" name="name" value="{{ old('name') }}" required autocomplete="name" />
                                @error('name') <span class="err">{{ $message }}</span> @enderror
                            </div>
                            <div class="field">
                                <label for="c-email">E-mail <span class="req">*</span></label>
                                <input type="email" id="c-email" name="email" value="{{ old('email') }}" required autocomplete="email" />
                                @error('email') <span class="err">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="field-row">
                            <div class="field">
                                <label for="c-phone">Téléphone</label>
                                <input type="tel" id="c-phone" name="phone" value="{{ old('phone') }}" autocomplete="tel" />
                                @error('phone') <span class="err">{{ $message }}</span> @enderror
                            </div>
                            <div class="field">
                                <label for="c-subject">Objet</label>
                                <input type="text" id="c-subject" name="subject" value="{{ old('subject') }}" />
                                @error('subject') <span class="err">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="field">
                            <label for="c-message">Message <span class="req">*</span></label>
                            <textarea id="c-message" name="message" required>{{ old('message') }}</textarea>
                            @error('message') <span class="err">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-dark">Envoyer le message <i class="fas fa-paper-plane"></i></button>
                        <p class="form-note">Les champs marqués d'un <span class="req">*</span> sont obligatoires. Vos données ne sont utilisées que pour traiter votre demande.</p>
                    </form>
                </div>
            </div>
        </div>

        <div class="map-frame reveal mt-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127638.97754706439!2d15.237412!3d-4.26336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1b6b0a3f6e7d8e0b%3A0x8f5e3c2a1b0d9e6f!2sPointe-Noire%2C%20Congo!5e0!3m2!1sfr!2scg!4v1712345678901" loading="lazy" title="Localisation de la SFP · Pointe-Noire, Congo"></iframe>
        </div>
    </div>
</section>
