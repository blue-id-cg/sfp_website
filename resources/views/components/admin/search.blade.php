@props([
    'name' => 'q',
    'value' => '',
    'placeholder' => 'Rechercher…',
    'action' => null,
    'label' => 'Rechercher',
])

<form method="GET" action="{{ $action ?? url()->current() }}" {{ $attributes->merge(['class' => 'admin-search']) }} role="search">
    <label for="admin-search-{{ $name }}" class="sr-only">{{ $label }}</label>
    <i class="hgi-stroke hgi-search-01 admin-search__icon" aria-hidden="true"></i>
    <input
        id="admin-search-{{ $name }}"
        type="search"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        autocomplete="off"
        class="admin-search__input"
    />
    {{ $slot }}
    @if ($value !== '')
        <a href="{{ $action ?? url()->current() }}" class="admin-search__clear" aria-label="Effacer la recherche">
            <i class="hgi-stroke hgi-cancel-01" aria-hidden="true"></i>
        </a>
    @endif
    <button type="submit" class="admin-search__submit">
        <i class="hgi-stroke hgi-search-01" aria-hidden="true"></i>
        <span>Rechercher</span>
    </button>
</form>
