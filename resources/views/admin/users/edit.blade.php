<x-app-layout>
    <x-slot name="header">Modifier l'utilisateur</x-slot>

    <x-admin.page-header title="Modifier l'utilisateur" subtitle="{{ $user->name }}" />

    <div class="form-card max-w-lg">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <x-admin.field name="name" label="Nom &amp; prénom" required>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autocomplete="name" class="@error('name') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="email" label="E-mail" required>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="email" class="@error('email') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="password" label="Mot de passe" hint="Laisser vide pour conserver le mot de passe actuel.">
                <input type="password" name="password" id="password" autocomplete="new-password" class="@error('password') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="password_confirmation" label="Confirmer le mot de passe">
                <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="@error('password_confirmation') invalid @enderror" />
            </x-admin.field>

            @can('manage roles')
                <x-admin.field name="role" label="Rôle" required>
                    <select name="role" id="role" required class="@error('role') invalid @enderror">
                        <option value="editor" @selected(old('role', $user->getRoleNames()->first()) === 'editor')>Éditeur — gère le contenu</option>
                        <option value="admin" @selected(old('role', $user->getRoleNames()->first()) === 'admin')>Administrateur — accès complet</option>
                    </select>
                </x-admin.field>
            @endcan

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                    Enregistrer
                </button>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            </div>
        </form>
    </div>
</x-app-layout>
