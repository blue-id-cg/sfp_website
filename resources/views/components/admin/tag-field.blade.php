@props(['name', 'label', 'hint' => null, 'value' => ''])

<x-admin.field :name="$name" :label="$label" :hint="$hint">
    <textarea name="{{ $name }}" id="{{ $name }}" data-tag-input rows="2" class="@error($name) invalid @enderror">{{ $value }}</textarea>
</x-admin.field>
