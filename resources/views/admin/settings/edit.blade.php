<x-app-layout>
    <x-slot name="header">Réglages du site</x-slot>

    <x-admin.page-header title="Réglages du site" subtitle="Coordonnées et chiffres clés partagés par plusieurs pages du site public." />

    <div class="form-card max-w-lg">
        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')

            <x-admin.field name="contact_address" label="Adresse">
                <input type="text" name="contact_address" id="contact_address" value="{{ old('contact_address', $setting->contact_address) }}" class="@error('contact_address') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="contact_phone" label="Téléphone">
                <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $setting->contact_phone) }}" class="@error('contact_phone') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="contact_email" label="E-mail">
                <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $setting->contact_email) }}" class="@error('contact_email') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="founding_year" label="Année de fondation" hint="Utilisée pour calculer « Années d'expérience ».">
                <input type="number" name="founding_year" id="founding_year" value="{{ old('founding_year', $setting->founding_year) }}" class="@error('founding_year') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="rigs_count" label="Nombre d'appareils de forage (rigs)">
                <input type="number" name="rigs_count" id="rigs_count" value="{{ old('rigs_count', $setting->rigs_count) }}" class="@error('rigs_count') invalid @enderror" />
            </x-admin.field>

            <x-admin.field name="incidents_count" label="Nombre d'incidents depuis la fondation">
                <input type="number" name="incidents_count" id="incidents_count" value="{{ old('incidents_count', $setting->incidents_count) }}" class="@error('incidents_count') invalid @enderror" />
            </x-admin.field>

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
