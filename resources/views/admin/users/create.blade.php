<x-app-layout>
    <x-slot name="header">Nouvel utilisateur</x-slot>

    <x-admin.page-header title="Nouvel utilisateur" subtitle="Donnez accès à l'administration à une nouvelle personne." />

    <div class="form-card max-w-lg">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <x-admin.field name="name" label="Nom &amp; prénom" required>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autocomplete="name" class="@error('name') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="email" label="E-mail" required>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" class="@error('email') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="password" label="Mot de passe" hint="8 caractères minimum." required>
                <input type="password" name="password" id="password" required autocomplete="new-password" class="@error('password') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="password_confirmation" label="Confirmer le mot de passe" required>
                <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" />
            </x-admin.field>

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                    Créer l'utilisateur
                </button>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            </div>
        </form>
    </div>
</x-app-layout>
