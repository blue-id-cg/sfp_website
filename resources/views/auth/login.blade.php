<x-guest-layout>
    @if (session('status'))
        <div class="form-alert ok show"><i class="hgi-stroke hgi-checkmark-circle-01"></i> <span>{{ session('status') }}</span></div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email') <span class="err">{{ $message }}</span> @enderror
        </div>

        <div class="field">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required autocomplete="current-password" />
            @error('password') <span class="err">{{ $message }}</span> @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-dark">Se connecter <i class="hgi-stroke hgi-arrow-right-01"></i></button>
        </div>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="mt-4 block text-center text-sm text-gray-500 hover:text-charcoal">
                Mot de passe oublié ?
            </a>
        @endif
    </form>
</x-guest-layout>
