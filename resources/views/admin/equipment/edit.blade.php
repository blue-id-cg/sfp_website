<x-app-layout>
    <x-slot name="header">Modifier l'équipement</x-slot>

    <x-admin.page-header title="Modifier l'équipement" subtitle="{{ $item->title }}" />

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.equipment.update', $item) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.equipment.form')
        </form>
    </div>
</x-app-layout>
