<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <div class="mx-auto flex flex-col gap-6" style="max-width: 250px;">
        @foreach ($toto as $message)
            <div class="bg-white p-4 rounded-lg border border-gray-300 shadow-md">
                <p>{{ $message->content }}</p>
                @if ($message->user !== null)
                    <p>{{ $message->user->name }}</p>
                @endif

                @if ($message->user_id === auth()->id())
                    <a href="{{ route('messages.edit', ['message' => $message->id]) }}">🖊️ Modifier</a>

                    <form method="POST" action="{{ route('messages.destroy', ['message' => $message->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">🗑️ Supprimer</button>
                    </form>
                @endif
            </div>
        @endforeach
        <div class="bg-white p-4 rounded-lg border border-gray-300 shadow-md">
            <form method="POST" class="space-y-2">
                @csrf
                <x-input-label for="content">Message</x-input-label>
                <textarea id="content" name="content" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                <x-primary-button>Envoyer</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
