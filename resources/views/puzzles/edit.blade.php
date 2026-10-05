<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editer un puzzle') }}
        </h2>
    </x-slot>

    <x-puzzles-card>

        @if (session()->has('message'))
            <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('puzzles.update', $puzzle->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <!-- Nom -->
            <div>
                <x-input-label for="nom" :value="__('Nom')" />

                <x-text-input
                    id="nom"
                    class="block mt-1 w-full"
                    type="text"
                    name="nom"
                    :value="old('nom', $puzzle->nom)"
                    required
                    autofocus
                />

                <x-input-error
                    :messages="$errors->get('nom')"
                    class="mt-2"
                />
            </div>

            <!-- Catégorie -->
            <div class="mt-4">
                <x-input-label for="categorie" :value="__('Categorie')" />

                <x-text-input
                    id="categorie"
                    class="block mt-1 w-full"
                    type="text"
                    name="categorie"
                    :value="old('categorie', $puzzle->categorie)"
                    required
                />

                <x-input-error
                    :messages="$errors->get('categorie')"
                    class="mt-2"
                />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />

                <textarea
                    id="description"
                    name="description"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                    rows="4"
                    required
                >{{ old('description', $puzzle->description) }}</textarea>

                <x-input-error
                    :messages="$errors->get('description')"
                    class="mt-2"
                />
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />

                <input
                    id="image"
                    class="block mt-1 w-full"
                    type="file"
                    name="image"
                    accept=".jpeg,.png,.jpg,.gif,.webp"
                />

                <x-input-error
                    :messages="$errors->get('image')"
                    class="mt-2"
                />
            </div>

            <!-- Prix -->
            <div class="mt-4">
                <x-input-label for="prix" :value="__('Prix')" />

                <x-text-input
                    id="prix"
                    class="block mt-1 w-full"
                    type="number"
                    name="prix"
                    step="0.01"
                    :value="old('prix', $puzzle->prix)"
                    required
                />

                <x-input-error
                    :messages="$errors->get('prix')"
                    class="mt-2"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Modifier') }}
                </x-primary-button>
            </div>

        </form>

    </x-puzzles-card>
</x-app-layout>