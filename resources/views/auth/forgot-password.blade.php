<x-guest-layout>
    <div class="auth-intro">
        Entrez votre adresse e-mail pour recevoir un lien sécurisé de réinitialisation.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
        @csrf

        <div class="field">
            <label for="email">Adresse e-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" aria-describedby="email-error" />
            @error('email') <span id="email-error" class="err">{{ $message }}</span> @enderror
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-dark">Envoyer le lien <i class="hgi-stroke hgi-arrow-right-01"></i></button>
        </div>
    </form>
</x-guest-layout>
