<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon panier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold mb-6">
                    Mon panier
                </h1>

                @if (session('message'))
                    <div class="mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                @if (count($panier) > 0)

                    @foreach ($panier as $id => $produit)

                        <div class="border-b py-6">

                            <h2 class="text-xl font-semibold">
                                {{ $produit['nom'] }}
                            </h2>

                            <p class="mt-2">
                                Prix : {{ $produit['prix'] }} €
                            </p>

                            <form action="{{ route('panier.modifier', $id) }}"
                                  method="POST"
                                  class="mt-3">

                                @csrf
                                @method('PATCH')

                                <label for="quantite-{{ $id }}">
                                    Quantité :
                                </label>

                                <input
                                    type="number"
                                    id="quantite-{{ $id }}"
                                    name="quantite"
                                    value="{{ $produit['quantite'] }}"
                                    min="1"
                                    class="border rounded px-2 py-1"
                                >

                                <button type="submit"
                                        class="bg-green-600 text-white px-3 py-1 rounded">
                                    Modifier
                                </button>

                            </form>

                            <form action="{{ route('panier.supprimer', $id) }}"
                                  method="POST"
                                  class="mt-3">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded">
                                    Supprimer
                                </button>

                            </form>

                        </div>

                    @endforeach

                @else

                    <p>
                        Votre panier est vide.
                    </p>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>