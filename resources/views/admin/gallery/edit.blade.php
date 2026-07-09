<x-app-layout>
    <x-slot name="header">Modifier l'image</x-slot>

    <x-admin.page-header title="Modifier l'image" subtitle="{{ $image->title ?: 'Sans titre' }}" />

    <div class="form-card max-w-xl">
        <form method="POST" action="{{ route('admin.gallery.update', $image) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.gallery.form')
        </form>
    </div>
</x-app-layout>
