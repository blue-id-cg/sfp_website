<x-app-layout>
    <x-slot name="header">Nouvelle actualité</x-slot>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-3xl">
        <form method="POST" action="{{ route('admin.actualites.store') }}" enctype="multipart/form-data">
            @include('admin.actualites.form')
        </form>
    </div>
</x-app-layout>
