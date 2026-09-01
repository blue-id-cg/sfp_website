<x-app-layout>
    <x-slot name="header">{{ $label }}</x-slot>

    <x-admin.page-header title="{{ $label }}" subtitle="Textes affichés sur cette page publique. Les cartes répétitives se gèrent depuis « Blocs de contenu »." />

    <form method="POST" action="{{ route('admin.pages.update', $page) }}" class="space-y-5">
        @csrf
        @method('PUT')

        @foreach ($schema as $sectionKey => $section)
            <div class="form-card">
                <h3 class="mb-4 text-sm font-semibold uppercase tracking-wide text-gray-500">{{ $section['label'] }}</h3>

                @foreach ($section['fields'] as $fieldKey => $field)
                    @php
                        $path = "content.{$sectionKey}.{$fieldKey}";
                        $value = old($path, $page->get("{$sectionKey}.{$fieldKey}"));
                        $name = "content[{$sectionKey}][{$fieldKey}]";
                    @endphp
                    <x-admin.field :name="$path" :label="$field['label']">
                        @if ($field['type'] === 'textarea')
                            <textarea name="{{ $name }}" id="{{ $path }}" rows="3" class="@error($path) invalid @enderror">{{ $value }}</textarea>
                        @else
                            <input type="text" name="{{ $name }}" id="{{ $path }}" value="{{ $value }}" class="@error($path) invalid @enderror" />
                        @endif
                    </x-admin.field>
                @endforeach
            </div>
        @endforeach

        <div class="flex items-center gap-3">
            <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                Enregistrer
            </button>
            <a href="{{ route('admin.pages.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Retour</a>
        </div>
    </form>
</x-app-layout>
