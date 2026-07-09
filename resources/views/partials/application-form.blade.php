@php
    $poste = $poste ?? null;
@endphp

<div class="form-card">
    <h3 class="title-md mb-3">{{ $heading ?? 'Postuler à cette offre' }}</h3>

    @if (session('contact_sent'))
        <div class="form-alert ok show"><i class="hgi-stroke hgi-checkmark-circle-01"></i> <span>Merci ! Votre candidature a bien été envoyée. Notre équipe RH vous recontactera.</span></div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        <input type="hidden" name="subject" value="Candidature — {{ $poste ?? 'Candidature spontanée' }}" />

        <div class="field-row">
            <div class="field">
                <label for="a-name">Nom &amp; prénom <span class="req">*</span></label>
                <input type="text" id="a-name" name="name" value="{{ old('name') }}" required autocomplete="name" />
                @error('name') <span class="err">{{ $message }}</span> @enderror
            </div>
            <div class="field">
                <label for="a-email">E-mail <span class="req">*</span></label>
                <input type="email" id="a-email" name="email" value="{{ old('email') }}" required autocomplete="email" />
                @error('email') <span class="err">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="field-row">
            <div class="field">
                <label for="a-phone">Téléphone <span class="req">*</span></label>
                <input type="tel" id="a-phone" name="phone" value="{{ old('phone') }}" required autocomplete="tel" />
                @error('phone') <span class="err">{{ $message }}</span> @enderror
            </div>
            <div class="field">
                <label for="a-poste">Poste</label>
                <input type="text" id="a-poste" value="{{ $poste ?? 'Candidature spontanée' }}" readonly />
            </div>
        </div>
        <div class="field">
            <label for="a-message">Message <span class="req">*</span></label>
            <textarea id="a-message" name="message" required placeholder="Présentez votre profil et votre expérience.">{{ old('message') }}</textarea>
            @error('message') <span class="err">{{ $message }}</span> @enderror
        </div>
        <div class="field">
            <label for="a-cv">CV <span class="text-muted" style="font-weight:400;">(PDF ou Word, 5 Mo max, facultatif)</span></label>
            <label for="a-cv" class="file-drop" data-file-drop>
                <i class="hgi-stroke hgi-cloud-upload"></i>
                <b>Cliquez ou déposez votre CV ici</b>
                <span class="fname" data-file-name>PDF, DOC ou DOCX</span>
            </label>
            <input type="file" id="a-cv" name="cv" accept=".pdf,.doc,.docx" class="sr-only" data-file-input />
            @error('cv') <span class="err">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Envoyer ma candidature <i class="hgi-stroke hgi-sent"></i></button>
        <p class="form-note">Les champs marqués d'un <span class="req">*</span> sont obligatoires. Notre équipe RH vous recontactera pour la suite de votre candidature.</p>
    </form>
</div>
