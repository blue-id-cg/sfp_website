@csrf

<x-admin.field name="title" label="Titre" required>
    <input type="text" name="title" id="title" value="{{ old('title', $actualite->title ?? '') }}" required class="@error('title') invalid @enderror" />
</x-admin.field>

<x-admin.field name="slug" label="Slug" hint="Laisser vide pour une génération automatique à partir du titre.">
    <input type="text" name="slug" id="slug" value="{{ old('slug', $actualite->slug ?? '') }}" class="@error('slug') invalid @enderror" />
</x-admin.field>

<x-admin.field name="category" label="Catégorie">
    <input type="text" name="category" id="category" value="{{ old('category', $actualite->category ?? '') }}" class="@error('category') invalid @enderror" />
</x-admin.field>

<x-admin.field name="excerpt" label="Résumé">
    <textarea name="excerpt" id="excerpt" rows="2" class="@error('excerpt') invalid @enderror">{{ old('excerpt', $actualite->excerpt ?? '') }}</textarea>
</x-admin.field>

<x-admin.field name="body" label="Contenu" hint="Markdown pris en charge (titres, listes, gras, liens…)." required>
    <textarea name="body" id="body" rows="10" class="font-mono text-sm @error('body') invalid @enderror">{{ old('body', $actualite->body ?? '') }}</textarea>
</x-admin.field>

<x-admin.file-field name="image" label="Image" :existing-url="$actualite->image_url ?? null" />

<x-admin.field name="published_at" label="Date de publication" hint="Laisser vide pour enregistrer comme brouillon.">
    <input type="date" name="published_at" id="published_at"
           value="{{ old('published_at', isset($actualite) && $actualite->published_at ? $actualite->published_at->format('Y-m-d') : '') }}"
           class="@error('published_at') invalid @enderror" />
</x-admin.field>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
        Enregistrer
    </button>
    <a href="{{ route('admin.actualites.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
</div>
