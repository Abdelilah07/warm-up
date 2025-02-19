<nav class="bg-white shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-700">
                Gestion des livres
            </a>

            <div class="hidden md:flex space-x-8">
                <a href="{{ route('livres.index') }}"
                    class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                    Liste des livres
                </a>
                <a href="{{ route('livres.create') }}"
                    class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                    Ajouter un livre
                </a>
            </div>
        </div>
    </div>
</nav>