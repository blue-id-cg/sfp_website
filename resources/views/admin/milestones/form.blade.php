@csrf

<x-admin.field name="year_label" label="Année / période" required hint="Ex. 2011, Depuis, Aujourd'hui, 2027.">
    <input type="text" name="year_label" id="year_label" value="{{ old('year_label', $milestone->year_label ?? '') }}" required class="@error('year_label') invalid @enderror" />
</x-admin.field>

<x-admin.field name="category" label="Catégorie" hint="Ex. Création, Croissance, Objectif.">
    <input type="text" name="category" id="category" value="{{ old('category', $milestone->category ?? '') }}" class="@error('category') invalid @enderror" />
</x-admin.field>

<x-admin.field name="title" label="Titre" required>
    <input type="text" name="title" id="title" value="{{ old('title', $milestone->title ?? '') }}" required class="@error('title') invalid @enderror" />
</x-admin.field>

<x-admin.field name="description" label="Description">
    <textarea name="description" id="description" rows="3" class="@error('description') invalid @enderror">{{ old('description', $milestone->description ?? '') }}</textarea>
</x-admin.field>

<x-admin.field name="position" label="Position" hint="Ordre d'affichage sur la frise (les plus petits en premier).">
    <input type="number" name="position" id="position" value="{{ old('position', $milestone->position ?? '') }}" class="@error('position') invalid @enderror" />
</x-admin.field>
