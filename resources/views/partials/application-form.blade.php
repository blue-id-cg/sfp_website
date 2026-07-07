@php
    $poste = $poste ?? null;
@endphp

<div class="form-card">
    <h3 class="title-md mb-3">{{ $heading ?? 'Postuler à cette offre' }}</h3>
    <div class="form-alert ok" data-apply-alert><i class="fas fa-circle-check"></i> <span>Merci ! Votre candidature a bien été envoyée. Notre équipe RH vous recontactera.</span></div>
    <form data-apply-form novalidate>
        <div class="field-row">
            <div class="field">
                <label for="a-nom">Nom <span class="req">*</span></label>
                <input type="text" id="a-nom" name="nom" required autocomplete="family-name" />
                <span class="err" data-err></span>
            </div>
            <div class="field">
                <label for="a-prenom">Prénom <span class="req">*</span></label>
                <input type="text" id="a-prenom" name="prenom" required autocomplete="given-name" />
                <span class="err" data-err></span>
            </div>
        </div>
        <div class="field-row">
            <div class="field">
                <label for="a-email">E-mail <span class="req">*</span></label>
                <input type="email" id="a-email" name="email" required autocomplete="email" />
                <span class="err" data-err></span>
            </div>
            <div class="field">
                <label for="a-tel">Téléphone <span class="req">*</span></label>
                <input type="tel" id="a-tel" name="telephone" required autocomplete="tel" />
                <span class="err" data-err></span>
            </div>
        </div>
        <div class="field">
            <label for="a-poste">Poste{{ $poste ? '' : ' souhaité' }}</label>
            <input type="text" id="a-poste" name="poste" value="{{ $poste }}" @if ($poste) readonly @else placeholder="Ex. Ingénieur forage" @endif />
            <span class="err" data-err></span>
        </div>
        <div class="field">
            <label for="a-cv">CV <span class="req">*</span></label>
            <div class="file-drop" data-file-drop>
                <i class="fas fa-cloud-arrow-up"></i>
                <div><b>Cliquez pour joindre votre CV</b> ou glissez-déposez le fichier</div>
                <span class="fname"></span>
            </div>
            <input type="file" id="a-cv" name="cv" accept=".pdf,.doc,.docx" required class="hide" />
            <span class="err" data-err></span>
        </div>
        <div class="field">
            <label for="a-lettre">Lettre de motivation</label>
            <textarea id="a-lettre" name="lettre" placeholder="Vos motivations pour rejoindre la SFP…"></textarea>
            <span class="err" data-err></span>
        </div>
        <div class="field">
            <label for="a-message">Message complémentaire</label>
            <textarea id="a-message" name="message" placeholder="Disponibilité, informations utiles…"></textarea>
            <span class="err" data-err></span>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer ma candidature <i class="fas fa-paper-plane"></i></button>
        <p class="form-note">Les champs marqués d'un <span class="req">*</span> sont obligatoires.</p>
    </form>
</div>
