@csrf

<x-admin.field name="title" label="Titre (texte alternatif)">
    <input type="text" name="title" id="title" value="{{ old('title', $image->title ?? '') }}" class="@error('title') invalid @enderror" />
</x-admin.field>

<x-admin.field name="caption" label="Légende">
    <input type="text" name="caption" id="caption" value="{{ old('caption', $image->caption ?? '') }}" class="@error('caption') invalid @enderror" />
</x-admin.field>

<x-admin.field name="position" label="Ordre d'affichage">
    <input type="number" name="position" id="position" min="0" value="{{ old('position', $image->position ?? '') }}" class="@error('position') invalid @enderror" />
</x-admin.field>

<x-admin.file-field name="image" label="Image" :existing-url="$image->image_url ?? null" :required="empty($image)" />

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
        Enregistrer
    </button>
    <a href="{{ route('admin.gallery.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
</div>
