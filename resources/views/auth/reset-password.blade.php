<x-guest-layout>
    <div class="auth-intro">
        Choisissez un nouveau mot de passe pour sécuriser votre compte.
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="field">
            <label for="email">Adresse e-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" aria-describedby="email-error" />
            @error('email') <span id="email-error" class="err">{{ $message }}</span> @enderror
        </div>

        <div class="field">
            <label for="password">Nouveau mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" aria-describedby="password-error" />
            @error('password') <span id="password-error" class="err">{{ $message }}</span> @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" aria-invalid="{{ $errors->has('password_confirmation') ? 'true' : 'false' }}" aria-describedby="password-confirmation-error" />
            @error('password_confirmation') <span id="password-confirmation-error" class="err">{{ $message }}</span> @enderror
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-dark">Réinitialiser le mot de passe <i class="hgi-stroke hgi-arrow-right-01"></i></button>
        </div>
    </form>
</x-guest-layout>
