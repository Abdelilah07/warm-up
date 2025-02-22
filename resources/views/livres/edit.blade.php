<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier Livres
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <h1 class="text-3xl font-bold mb-6">Modifier un Livre</h1>

        <div id="messages"></div>

        <form id="edit-book-form"
            action="{{ route('livres.update', $livre) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
                <input type="text"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    id="titre"
                    name="titre"
                    value="{{ old('titre', $livre->titre) }}"
                    required>
            </div>

            <div class="space-y-2">
                <label for="pages" class="block text-sm font-medium text-gray-700">Pages</label>
                <input type="number"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    id="pages"
                    name="pages"
                    value="{{ old('pages', $livre->pages) }}"
                    required>
            </div>

            <div class="space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    id="description"
                    name="description"
                    rows="4"
                    required>{{ old('description', $livre->description) }}</textarea>
            </div>

            <div class="space-y-2">
                <label for="categorie_id" class="block text-sm font-medium text-gray-700">Categorie</label>
                <select
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    id="categorie_id"
                    name="categorie_id"
                    required>
                    <option value="">Sélectionner une categorie</option>
                    @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}"
                        {{ old('categorie_id', $livre->categorie_id) == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Image actuelle</label>
                <img src="{{ asset('storage/' . $livre->image) }}"
                    alt="Image actuelle"
                    class="w-24 h-24 object-cover rounded-md">
            </div>

            <div class="space-y-2">
                <label for="image" class="block text-sm font-medium text-gray-700">Nouvelle image (optionnel)</label>
                <input type="file"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                    id="image"
                    name="image">
            </div>

            <div class="flex gap-4 mt-8">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Mettre à jour
                </button>
                <a href="{{ route('livres.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</x-app-layout>