<x-app-layout>
    <x-slot name="header">Ajouter une image</x-slot>

    <x-admin.page-header title="Ajouter une image" subtitle="Ajoutez une photo à la galerie du site." />

    <div class="form-card max-w-xl">
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
            @include('admin.gallery.form')
        </form>
    </div>
</x-app-layout>
