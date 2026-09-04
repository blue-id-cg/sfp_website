<x-guest-layout>
    @if (session('status'))
        <div class="form-alert ok show"><i class="hgi-stroke hgi-checkmark-circle-01"></i> <span>{{ session('status') }}</span></div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form" novalidate>
        @csrf

        <div class="field">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" aria-describedby="email-error" />
            @error('email') <span id="email-error" class="err">{{ $message }}</span> @enderror
        </div>

        <div class="field">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required autocomplete="current-password" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" aria-describedby="password-error" />
            @error('password') <span id="password-error" class="err">{{ $message }}</span> @enderror
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn btn-dark">Se connecter <i class="hgi-stroke hgi-arrow-right-01"></i></button>
        </div>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="auth-link">
                Mot de passe oublié ?
            </a>
        @endif
    </form>
</x-guest-layout>
