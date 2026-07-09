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
        <label for="title" class="block text-sm font-medium text-gray-700">Titre (texte alternatif)</label>
        <input type="text" name="title" id="title" value="{{ old('title', $image->title ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>

    <div>
        <label for="caption" class="block text-sm font-medium text-gray-700">Légende</label>
        <input type="text" name="caption" id="caption" value="{{ old('caption', $image->caption ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>

    <div>
        <label for="position" class="block text-sm font-medium text-gray-700">Ordre d'affichage</label>
        <input type="number" name="position" id="position" min="0" value="{{ old('position', $image->position ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
        @if (! empty($image) && $image->image_url)
            <img src="{{ $image->image_url }}" alt="" class="mt-2 mb-2 h-24 w-auto rounded-md object-cover" />
        @endif
        <input type="file" name="image" id="image" accept="image/*" {{ empty($image) ? 'required' : '' }}
               class="mt-1 block w-full text-sm text-gray-700" />
    </div>
</div>

<div class="mt-6 flex items-center gap-3">
    <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
        Enregistrer
    </button>
    <a href="{{ route('admin.gallery.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
</div>
