@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-gray-800 mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>
