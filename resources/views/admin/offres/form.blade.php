@csrf

<x-admin.field name="title" label="Titre" required>
    <input type="text" name="title" id="title" value="{{ old('title', $offre->title ?? '') }}" required class="@error('title') invalid @enderror" />
</x-admin.field>

<x-admin.field name="slug" label="Slug" hint="Laisser vide pour une génération automatique à partir du titre.">
    <input type="text" name="slug" id="slug" value="{{ old('slug', $offre->slug ?? '') }}" class="@error('slug') invalid @enderror" />
</x-admin.field>

@php
    $tagsValue = is_array(old('tags'))
        ? implode("\n", old('tags'))
        : old('tags', isset($offre) ? implode("\n", $offre->tags ?? []) : '');
@endphp
<x-admin.tag-field
    name="tags"
    label="Tags"
    hint="Appuyez sur Entrée ou virgule pour ajouter un tag, ex. Brazzaville, CDI, Forage."
    :value="$tagsValue"
/>

<x-admin.field name="summary" label="Résumé">
    <textarea name="summary" id="summary" rows="2" class="@error('summary') invalid @enderror">{{ old('summary', $offre->summary ?? '') }}</textarea>
</x-admin.field>

<x-admin.field name="missions" label="Missions" hint="Une par ligne.">
    <textarea name="missions" id="missions" rows="5" class="@error('missions') invalid @enderror">{{ is_array(old('missions')) ? implode("\n", old('missions')) : old('missions', isset($offre) ? implode("\n", $offre->missions ?? []) : '') }}</textarea>
</x-admin.field>

<x-admin.field name="profile" label="Profil recherché" hint="Une ligne par critère.">
    <textarea name="profile" id="profile" rows="5" class="@error('profile') invalid @enderror">{{ is_array(old('profile')) ? implode("\n", old('profile')) : old('profile', isset($offre) ? implode("\n", $offre->profile ?? []) : '') }}</textarea>
</x-admin.field>

<x-admin.field name="published_at" label="Date de publication" hint="Laisser vide pour enregistrer comme brouillon.">
    <input type="date" name="published_at" id="published_at"
           value="{{ old('published_at', isset($offre) && $offre->published_at ? $offre->published_at->format('Y-m-d') : '') }}"
           class="@error('published_at') invalid @enderror" />
</x-admin.field>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
        Enregistrer
    </button>
    <a href="{{ route('admin.offres.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
</div>
