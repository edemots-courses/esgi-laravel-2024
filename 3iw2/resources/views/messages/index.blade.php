<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <section class="flex-1 w-full max-w-sm mx-auto py-12 flex flex-col gap-8">
        <div class="flex-1 flex flex-col justify-end gap-4 overflow-y-auto">
            @foreach($messages as $message)
                <article class="px-4 py-3 bg-white border shadow rounded-xl space-y-4">
                    <p>{{ $message->content }}</p>
                    <div>
                        <p class="leading-none">{{ $message->author_name }}</p>
                        <time class="text-sm text-slate-500">{{ $message->published_at->diffForHumans() }}</time>
                    </div>
                </article>
            @endforeach
        </div>
        <form action="{{ route('messages.store') }}" method="post" class="px-4 py-3 bg-white border shadow rounded-xl space-y-2">
            @csrf

            <div>
                <textarea name="content" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('content')" />
            </div>
            <div>
                <x-input-label for="author_name" value="Auteur" />
                <x-text-input id="author_name" name="author_name" type="text" class="mt-1 block w-full" :value="old('author_name')" autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('author_name')" />
            </div>
            <x-primary-button>Envoyer</x-primary-button>
        </form>
    </section>
</x-app-layout>
