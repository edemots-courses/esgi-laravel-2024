<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le Tag : {{ $tag->name }}
        </h2>
    </x-slot>

    <form action="{{ route('tags.update', ['tag' => $tag]) }}" method="POST" class="px-4 py-3 bg-white border shadow rounded-xl space-y-2">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="name" value="Nom du tag" />
            <x-text-input id="name" name="name" :value="$tag->name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="color" value="Couleur" />
            <x-text-input type="color" id="color" name="color" value="#{{$tag->color}}" />
            <x-input-error class="mt-2" :messages="$errors->get('color')" />
        </div>

        <x-primary-button>Envoyer</x-primary-button>
    </form>
</x-app-layout>
