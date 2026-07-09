<x-app-layout>
    <x-slot name="header">Ajouter une image</x-slot>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-xl">
        <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
            @include('admin.gallery.form')
        </form>
    </div>
</x-app-layout>
