@csrf

@if ($errors->any())
    <div class="mb-4 rounded-md bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="space-y-4">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
        <input type="text" name="title" id="title" value="{{ old('title', $actualite->title ?? '') }}" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>

    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug (laisser vide pour génération automatique)</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $actualite->slug ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>

    <div>
        <label for="category" class="block text-sm font-medium text-gray-700">Catégorie</label>
        <input type="text" name="category" id="category" value="{{ old('category', $actualite->category ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>

    <div>
        <label for="excerpt" class="block text-sm font-medium text-gray-700">Résumé</label>
        <textarea name="excerpt" id="excerpt" rows="2"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('excerpt', $actualite->excerpt ?? '') }}</textarea>
    </div>

    <div>
        <label for="body" class="block text-sm font-medium text-gray-700">Contenu (Markdown)</label>
        <textarea name="body" id="body" rows="10"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm font-mono text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('body', $actualite->body ?? '') }}</textarea>
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
        @if (! empty($actualite) && $actualite->image_url)
            <img src="{{ $actualite->image_url }}" alt="" class="mt-2 mb-2 h-24 w-auto rounded-md object-cover" />
        @endif
        <input type="file" name="image" id="image" accept="image/*"
               class="mt-1 block w-full text-sm text-gray-700" />
    </div>

    <div>
        <label for="published_at" class="block text-sm font-medium text-gray-700">Date de publication (laisser vide pour un brouillon)</label>
        <input type="date" name="published_at" id="published_at"
               value="{{ old('published_at', isset($actualite) && $actualite->published_at ? $actualite->published_at->format('Y-m-d') : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
        Enregistrer
    </button>
    <a href="{{ route('admin.actualites.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
</div>
