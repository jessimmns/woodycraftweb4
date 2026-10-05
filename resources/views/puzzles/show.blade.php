<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Afficher un puzzle')
        </h2>
    </x-slot>

    <x-puzzles-card>
        <h3 class="font-semibold text-xl text-gray-800">
            @lang('Nom')
        </h3>
        <p>{{ $puzzle->nom }}</p>

        <h3 class="font-semibold text-xl text-gray-800 pt-2">
            @lang('Catégorie')
        </h3>
        <p>{{ $puzzle->categorie }}</p>

        <h3 class="font-semibold text-xl text-gray-800 pt-2">
            @lang('Description')
        </h3>
        <p>{{ $puzzle->description }}</p>

        <h3 class="font-semibold text-xl text-gray-800 pt-2">
            @lang('Image')
        </h3>

        @if ($puzzle->image)
            <img
                src="{{ asset('storage/' . $puzzle->image) }}"
                alt="{{ $puzzle->nom }}"
                class="w-40 h-40 object-cover rounded"
            >
        @endif

        <h3 class="font-semibold text-xl text-gray-800 pt-2">
            @lang('Prix')
        </h3>
        <p>{{ $puzzle->prix }} €</p>

        <h3 class="font-semibold text-xl text-gray-800 pt-2">
            @lang('Date création')
        </h3>
        <p>{{ $puzzle->created_at->format('d/m/Y') }}</p>

        @if ($puzzle->created_at != $puzzle->updated_at)
            <h3 class="font-semibold text-xl text-gray-800 pt-2">
                @lang('Dernière mise à jour')
            </h3>
            <p>{{ $puzzle->updated_at->format('d/m/Y') }}</p>
        @endif

        <form action="{{ route('panier.ajouter', $puzzle) }}" method="POST">
            @csrf

            <button
                type="submit"
                class="mt-4 bg-blue-600 text-white px-4 py-2 rounded"
            >
                @lang('Ajouter au panier')
            </button>
        </form>

    </x-puzzles-card>
</x-app-layout>