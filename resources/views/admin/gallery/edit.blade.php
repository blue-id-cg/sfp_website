<x-app-layout>
    <x-slot name="header">Modifier l'image</x-slot>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-xl">
        <form method="POST" action="{{ route('admin.gallery.update', $image) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.gallery.form')
        </form>
    </div>
</x-app-layout>
