<x-app-layout>
    <x-slot name="header">Modifier l'actualité</x-slot>

    <x-admin.page-header title="Modifier l'actualité" subtitle="{{ $actualite->title }}" />

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.actualites.update', $actualite) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.actualites.form')
        </form>
    </div>
</x-app-layout>
