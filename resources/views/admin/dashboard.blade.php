<x-app-layout>
    <x-slot name="header">Tableau de bord</x-slot>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <p class="text-sm text-gray-500">Actualités</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $actualitesCount }}</p>
            <a href="{{ route('admin.actualites.index') }}" class="mt-4 inline-block text-sm text-blue-600 hover:underline">Gérer</a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <p class="text-sm text-gray-500">Offres d'emploi</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $offresCount }}</p>
            <a href="{{ route('admin.offres.index') }}" class="mt-4 inline-block text-sm text-blue-600 hover:underline">Gérer</a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <p class="text-sm text-gray-500">Photos en galerie</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $galleryCount }}</p>
            <a href="{{ route('admin.gallery.index') }}" class="mt-4 inline-block text-sm text-blue-600 hover:underline">Gérer</a>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <p class="text-sm text-gray-500">Messages non lus</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $unreadMessagesCount }}</p>
            <a href="{{ route('admin.messages.index') }}" class="mt-4 inline-block text-sm text-blue-600 hover:underline">Consulter</a>
        </div>
    </div>
</x-app-layout>
