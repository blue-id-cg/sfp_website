@csrf

<x-admin.field name="title" label="Titre" required>
    <input type="text" name="title" id="title" value="{{ old('title', $realisation->title ?? '') }}" required class="@error('title') invalid @enderror" />
</x-admin.field>

<x-admin.field name="slug" label="Slug" hint="Laisser vide pour une génération automatique à partir du titre.">
    <input type="text" name="slug" id="slug" value="{{ old('slug', $realisation->slug ?? '') }}" class="@error('slug') invalid @enderror" />
</x-admin.field>

<x-admin.field name="category" label="Catégorie">
    <input type="text" name="category" id="category" value="{{ old('category', $realisation->category ?? '') }}" class="@error('category') invalid @enderror" />
</x-admin.field>

<x-admin.field name="description" label="Description">
    <textarea name="description" id="description" rows="4" class="@error('description') invalid @enderror">{{ old('description', $realisation->description ?? '') }}</textarea>
</x-admin.field>

<x-admin.file-field name="image" label="Image" :existing-url="$realisation->image_url ?? null" />

@php
    $factsToLines = fn ($facts) => collect($facts ?? [])->map(fn ($fact) => ($fact['icon'] ?? null) ? "{$fact['icon']}|{$fact['text']}" : ($fact['text'] ?? ''))->implode("\n");
@endphp
<x-admin.field name="facts" label="Points clés" hint="Un par ligne, au format « icone|texte » (icône facultative), ex. hgi-location-01|Pointe-Noire.">
    <textarea name="facts" id="facts" rows="4" class="@error('facts') invalid @enderror">{{ is_array(old('facts')) ? $factsToLines(old('facts')) : old('facts', $factsToLines($realisation->facts ?? [])) }}</textarea>
</x-admin.field>

@php
    $tagsValue = is_array(old('tags'))
        ? implode("\n", old('tags'))
        : old('tags', isset($realisation) ? implode("\n", $realisation->tags ?? []) : '');
@endphp
<x-admin.tag-field name="tags" label="Tags" :value="$tagsValue" />

<x-admin.field name="position" label="Position" hint="Ordre d'affichage (les plus petits en premier).">
    <input type="number" name="position" id="position" value="{{ old('position', $realisation->position ?? '') }}" class="@error('position') invalid @enderror" />
</x-admin.field>

<x-admin.field name="published_at" label="Date de publication" hint="Laisser vide pour enregistrer comme brouillon.">
    <input type="date" name="published_at" id="published_at"
           value="{{ old('published_at', isset($realisation) && $realisation->published_at ? $realisation->published_at->format('Y-m-d') : '') }}"
           class="@error('published_at') invalid @enderror" />
</x-admin.field>
