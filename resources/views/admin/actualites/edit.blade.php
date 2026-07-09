<x-app-layout>
    <x-slot name="header">Modifier l'actualité</x-slot>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-3xl">
        <form method="POST" action="{{ route('admin.actualites.update', $actualite) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.actualites.form')
        </form>
    </div>
</x-app-layout>
