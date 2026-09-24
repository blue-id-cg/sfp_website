@csrf

<x-admin.field name="title" label="Titre" required>
    <input type="text" name="title" id="title" value="{{ old('title', $item->title ?? '') }}" required class="@error('title') invalid @enderror" />
</x-admin.field>

<x-admin.field name="slug" label="Slug" hint="Laisser vide pour une génération automatique à partir du titre.">
    <input type="text" name="slug" id="slug" value="{{ old('slug', $item->slug ?? '') }}" class="@error('slug') invalid @enderror" />
</x-admin.field>

<x-admin.field name="description" label="Description courte" hint="Affichée sur la carte de la page Équipements.">
    <textarea name="description" id="description" rows="3" class="@error('description') invalid @enderror">{{ old('description', $item->description ?? '') }}</textarea>
</x-admin.field>

<x-admin.field name="body" label="Fiche descriptive" hint="Détails techniques affichés sur la page publique.">
    <textarea name="body" id="body" rows="10" data-quill class="@error('body') invalid @enderror">{{ old('body', $item->body ?? '') }}</textarea>
</x-admin.field>

<x-admin.file-field name="image" label="Photo" :existing-url="$item->image_url ?? null" />

<x-admin.field name="spec_sheet" label="Fiche technique (PDF)" :hint="isset($item) && $item->spec_sheet ? 'Un fichier est déjà en ligne — en choisir un nouveau le remplacera.' : 'Facultatif. Téléchargeable depuis la page publique.'">
    <input type="file" name="spec_sheet" id="spec_sheet" accept="application/pdf" class="@error('spec_sheet') invalid @enderror" />
    @if (isset($item) && $item->spec_sheet)
        <p class="mt-1 text-xs text-gray-500">
            Fichier actuel : <a href="{{ $item->spec_sheet_url }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($item->spec_sheet) }}</a>
        </p>
    @endif
</x-admin.field>

<x-admin.field name="trades" label="Métiers concernés" hint="Sélectionnez les métiers qui utilisent cet équipement.">
    <div class="flex flex-wrap gap-2">
        @foreach ($trades as $trade)
            <label class="inline-flex cursor-pointer items-center gap-2 rounded-md border border-gray-200 px-3 py-1.5 text-sm has-[:checked]:border-[#0C0E22] has-[:checked]:bg-gray-50">
                <input type="checkbox" name="trades[]" value="{{ $trade->id }}" class="rounded" @checked(in_array($trade->id, old('trades', $selectedTradeIds ?? []))) />
                {{ $trade->title }}
            </label>
        @endforeach
    </div>
</x-admin.field>

<x-admin.field name="position" label="Position" hint="Ordre d'affichage dans la liste des équipements (les plus petits en premier).">
    <input type="number" name="position" id="position" value="{{ old('position', $item->position ?? '') }}" class="@error('position') invalid @enderror" />
</x-admin.field>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
        Enregistrer
    </button>
    <a href="{{ route('admin.equipment.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
</div>
