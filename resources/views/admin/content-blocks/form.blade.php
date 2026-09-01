@csrf

@php
    $groupValue = old('group', $block->group ?? '');
    $iconValue = old('icon', $block->icon ?? '');
@endphp

<x-admin.field name="group" label="Groupe" required hint="Section de contenu à laquelle ce bloc appartient — détermine où il apparaît sur le site public.">
    <select name="group" id="group" required class="@error('group') invalid @enderror">
        <option value="" disabled @selected($groupValue === '')>Sélectionner un groupe…</option>
        @foreach (\App\Models\ContentBlock::GROUP_LABELS as $slug => $label)
            <option value="{{ $slug }}" @selected($groupValue === $slug)>{{ $label }}</option>
        @endforeach
    </select>
</x-admin.field>

<x-admin.field name="icon" label="Icône" hint="Cliquez pour choisir une icône dans la liste ci-dessous.">
    <div data-icon-picker class="relative">
        <input type="hidden" name="icon" id="icon" value="{{ $iconValue }}" data-icon-value />

        <button type="button" data-icon-trigger class="flex w-full items-center gap-2.5 rounded-md border border-gray-200 px-3 py-2 text-left text-sm hover:border-gray-400 @error('icon') invalid @enderror">
            <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-md bg-gray-50 text-gray-500">
                <i data-icon-preview class="hgi-stroke {{ $iconValue }}" @style(['visibility: hidden' => $iconValue === ''])></i>
            </span>
            <span data-icon-label class="flex-1 {{ $iconValue ? 'text-gray-900' : 'text-gray-400' }}">{{ $iconValue ?: 'Aucune icône' }}</span>
            <i class="hgi-stroke hgi-arrow-down-01 text-xs text-gray-400"></i>
        </button>

        <div data-icon-panel hidden class="absolute z-10 mt-1.5 max-h-72 w-full overflow-y-auto rounded-lg border border-gray-200 bg-white p-3 shadow-lg">
            <button type="button" data-icon-option="" class="mb-2 flex w-full items-center gap-2 rounded-md px-2 py-1.5 text-left text-xs text-gray-500 hover:bg-gray-50">
                <span class="inline-flex h-6 w-6 items-center justify-center rounded bg-gray-50">—</span> Aucune icône
            </button>
            @foreach (\App\Models\ContentBlock::ICON_PALETTE as $category => $classes)
                <p class="mb-1.5 mt-3 text-[0.65rem] font-semibold uppercase tracking-wide text-gray-400 first:mt-0">{{ $category }}</p>
                <div class="grid grid-cols-8 gap-1.5">
                    @foreach ($classes as $class)
                        <button type="button" data-icon-option="{{ $class }}" title="{{ $class }}" class="flex h-9 w-9 items-center justify-center rounded-md text-gray-600 hover:bg-gray-100">
                            <i class="hgi-stroke {{ $class }}"></i>
                        </button>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-admin.field>

<x-admin.field name="title" label="Titre" required>
    <input type="text" name="title" id="title" value="{{ old('title', $block->title ?? '') }}" required class="@error('title') invalid @enderror" />
</x-admin.field>

<x-admin.field name="description" label="Description">
    <textarea name="description" id="description" rows="3" class="@error('description') invalid @enderror">{{ old('description', $block->description ?? '') }}</textarea>
</x-admin.field>

<x-admin.field name="meta" label="Données supplémentaires" hint="Facultatif. Une paire clé: valeur par ligne (ex. figure: 1080, unite: HP).">
    @php
        $metaToLines = fn ($meta) => collect($meta ?? [])->map(fn ($value, $key) => "{$key}: {$value}")->implode("\n");
    @endphp
    <textarea name="meta" id="meta" rows="3" class="@error('meta') invalid @enderror">{{ is_array(old('meta')) ? $metaToLines(old('meta')) : old('meta', $metaToLines($block->meta ?? [])) }}</textarea>
</x-admin.field>

<x-admin.field name="position" label="Position" hint="Ordre d'affichage au sein du groupe (les plus petits en premier).">
    <input type="number" name="position" id="position" value="{{ old('position', $block->position ?? '') }}" class="@error('position') invalid @enderror" />
</x-admin.field>
