<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier un message
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('messages.update', ['message' => $message->id]) }}">
        @csrf
        @method('PUT')
        <x-input-label for="content">Message</x-input-label>
        <textarea id="content" name="content" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $message->content }}</textarea>
        <x-primary-button>Modifier</x-primary-button>
        <a href="{{ route('messages.index') }}">Annuler</a>
    </form>
</x-app-layout>
