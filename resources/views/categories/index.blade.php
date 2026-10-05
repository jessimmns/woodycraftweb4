<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catégories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">
                    Liste des catégories
                </h1>

                @foreach ($categories as $categorie)
                    <div class="mb-3">
                        <a href="{{ route('categories.show', $categorie) }}"
                           class="text-blue-600 hover:underline">
                            {{ $categorie->nom }}
                        </a>
                    </div>
                @endforeach

            </div>

        </div>
    </div>

</x-app-layout>