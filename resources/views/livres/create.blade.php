@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-3xl font-bold mb-6">Ajouter un livre</h1>

    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
        <ul class="list-disc pl-4">
            @foreach($errors->all() as $error)
            <li class="text-red-700">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="create-book-form" onsubmit="event.preventDefault(); handleCreateSubmit();"
        enctype="multipart/form-data"
        class="space-y-6">
        @csrf

        <div class="space-y-2">
            <label for="titre" class="block text-sm font-medium text-gray-700">Titre</label>
            <input type="text"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                id="titre"
                name="titre"
                value="{{ old('titre') }}"
                required>
        </div>

        <div class="space-y-2">
            <label for="pages" class="block text-sm font-medium text-gray-700">Pages</label>
            <input type="number"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                id="pages"
                name="pages"
                value="{{ old('pages') }}"
                required>
        </div>

        <div class="space-y-2">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                id="description"
                name="description"
                rows="4"
                required>{{ old('description') }}</textarea>
        </div>

        <div class="space-y-2">
            <label for="categorie_id" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <select
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                id="categorie_id"
                name="categorie_id"
                required>
                <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}"
                    {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                    {{ $categorie->nom }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="space-y-2">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                id="image"
                name="image"
                required>
        </div>

        <div class="flex gap-4 mt-8">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Enregistrer
            </button>
            <a href="{{ route('livres.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Annuler
            </a>
        </div>
    </form>

    <script>
        function handleCreateSubmit() {
            const form = document.getElementById('create-book-form');
            const formData = new FormData(form);
            createBook(formData);
        }
    </script>
</div>
@endsection