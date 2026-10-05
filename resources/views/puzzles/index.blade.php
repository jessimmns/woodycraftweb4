<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des puzzles') }}
        </h2>
    </x-slot>

    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">

                <div class="border-b border-gray-200 shadow pt-6">

                    @if (session()->has('message'))
                        <div class="mt-3 mb-4 text-sm text-green-600">
                            {{ session('message') }}
                        </div>
                    @endif

                    <table>

                        <thead class="bg-gray-50">
                            <tr>

                                <th class="px-2 py-2 text-xs text-gray-500">
                                    #
                                </th>

                                <th class="px-2 py-2 text-xs text-gray-500">
                                    Nom
                                </th>

                                <th class="px-2 py-2 text-xs text-gray-500">
                                    Catégorie
                                </th>

                                <th class="px-2 py-2 text-xs text-gray-500">
                                    Image
                                </th>

                                <th class="px-2 py-2 text-xs text-gray-500">
                                    Prix
                                </th>

                                <th class="px-2 py-2 text-xs text-gray-500">
                                </th>

                                <th class="px-2 py-2 text-xs text-gray-500">
                                </th>

                                <th class="px-2 py-2 text-xs text-gray-500">
                                </th>

                            </tr>
                        </thead>

                        <tbody class="bg-white">

                            @foreach ($puzzles as $puzzle)

                                <tr class="whitespace-nowrap">

                                    <td class="px-4 py-4 text-sm text-gray-500">
                                        {{ $puzzle->id }}
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $puzzle->nom }}
                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $puzzle->categorie }}
                                    </td>

                                    <td class="px-4 py-4">

                                        @if ($puzzle->image)

                                            <img
                                                src="{{ asset('storage/' . $puzzle->image) }}"
                                                alt="{{ $puzzle->nom }}"
                                                class="w-20 h-20 object-cover rounded"
                                            >

                                        @endif

                                    </td>

                                    <td class="px-4 py-4">
                                        {{ $puzzle->prix }} €
                                    </td>

                                    <td class="px-2 py-2">

                                        <a
                                            href="{{ route('puzzles.show', $puzzle->id) }}"
                                            class="inline-flex items-center px-2 py-1 bg-gray-800 text-white rounded-md"
                                        >
                                            Show
                                        </a>

                                    </td>

                                    <td class="px-2 py-2">

                                        <a
                                            href="{{ route('puzzles.edit', $puzzle->id) }}"
                                            class="inline-flex items-center px-2 py-1 bg-gray-800 text-white rounded-md"
                                        >
                                            Edit
                                        </a>

                                    </td>

                                    <td class="px-2 py-2">

                                        <form
                                            action="{{ route('puzzles.destroy', $puzzle->id) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center px-2 py-1 bg-red-600 text-white rounded-md"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>