@props(['name', 'label', 'existingUrl' => null, 'required' => false])

<div class="field">
    <label for="{{ $name }}">{{ $label }} @if ($required)<span class="req">*</span>@endif</label>

    @if ($existingUrl)
        <img src="{{ $existingUrl }}" alt="" class="mb-2 h-24 w-auto rounded-md object-cover" />
    @endif

    <label for="{{ $name }}" class="file-drop" data-file-drop>
        <i class="hgi-stroke hgi-cloud-upload"></i>
        <b>Cliquez ou déposez une image ici</b>
        <span class="fname" data-file-name>{{ $existingUrl ? "Remplacer l'image actuelle" : 'PNG ou JPG' }}</span>
    </label>
    <input type="file" name="{{ $name }}" id="{{ $name }}" accept="image/*" class="sr-only" {{ $required ? 'required' : '' }} data-file-input />

    @error($name)
        <span class="err">{{ $message }}</span>
    @enderror
</div>
