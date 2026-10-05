<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $categorie->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">
                    Liste des puzzles de la catégorie :
                    {{ $categorie->nom }}
                </h1>

                @if ($puzzles->count() > 0)

                    @foreach ($puzzles as $puzzle)

                        <div class="border-b border-gray-200 py-6">

                            <h2 class="text-xl font-semibold">
                                <a href="{{ route('puzzles.show', $puzzle) }}"
                                   class="text-blue-600 hover:underline">
                                    {{ $puzzle->nom }}
                                </a>
                            </h2>

                            @if ($puzzle->image)
                                <img
                                    src="{{ asset('storage/' . $puzzle->image) }}"
                                    alt="{{ $puzzle->nom }}"
                                    class="w-40 h-40 object-cover rounded mt-3"
                                >
                            @endif

                            <p class="mt-3">
                                <strong>Prix :</strong>
                                {{ $puzzle->prix }} €
                            </p>

                            <p class="mt-2">
                                <strong>Description :</strong>
                                {{ $puzzle->description }}
                            </p>

                        </div>

                    @endforeach

                @else

                    <p class="text-gray-600">
                        Aucun puzzle dans cette catégorie.
                    </p>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>