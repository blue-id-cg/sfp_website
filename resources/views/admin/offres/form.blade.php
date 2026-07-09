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
        <input type="text" name="title" id="title" value="{{ old('title', $offre->title ?? '') }}" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>

    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700">Slug (laisser vide pour génération automatique)</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $offre->slug ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>

    <div>
        <label for="tags" class="block text-sm font-medium text-gray-700">Tags (un par ligne, ex. Brazzaville, CDI, Forage)</label>
        <textarea name="tags" id="tags" rows="3"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('tags', isset($offre) ? implode("\n", $offre->tags ?? []) : '') }}</textarea>
    </div>

    <div>
        <label for="summary" class="block text-sm font-medium text-gray-700">Résumé</label>
        <textarea name="summary" id="summary" rows="2"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('summary', $offre->summary ?? '') }}</textarea>
    </div>

    <div>
        <label for="missions" class="block text-sm font-medium text-gray-700">Missions (une par ligne)</label>
        <textarea name="missions" id="missions" rows="5"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('missions', isset($offre) ? implode("\n", $offre->missions ?? []) : '') }}</textarea>
    </div>

    <div>
        <label for="profile" class="block text-sm font-medium text-gray-700">Profil recherché (une ligne par critère)</label>
        <textarea name="profile" id="profile" rows="5"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('profile', isset($offre) ? implode("\n", $offre->profile ?? []) : '') }}</textarea>
    </div>

    <div>
        <label for="published_at" class="block text-sm font-medium text-gray-700">Date de publication (laisser vide pour un brouillon)</label>
        <input type="date" name="published_at" id="published_at"
               value="{{ old('published_at', isset($offre) && $offre->published_at ? $offre->published_at->format('Y-m-d') : '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
        Enregistrer
    </button>
    <a href="{{ route('admin.offres.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
</div>
