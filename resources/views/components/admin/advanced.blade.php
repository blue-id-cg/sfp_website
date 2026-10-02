@props(['label' => 'Options avancées'])

<details class="mt-2 rounded-md border border-gray-200">
    <summary class="cursor-pointer select-none px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
        {{ $label }}
    </summary>
    <div class="space-y-4 border-t border-gray-200 p-3">
        {{ $slot }}
    </div>
</details>
