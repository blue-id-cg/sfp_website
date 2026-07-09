@props(['name', 'label', 'hint' => null, 'required' => false])

<div class="field">
    <label for="{{ $name }}">{{ $label }} @if ($required)<span class="req">*</span>@endif</label>
    {{ $slot }}
    @if ($hint)
        <p class="text-xs text-gray-400">{{ $hint }}</p>
    @endif
    @error($name)
        <span class="err">{{ $message }}</span>
    @enderror
</div>
