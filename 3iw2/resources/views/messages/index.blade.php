<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>
    
    <section class="flex-none max-w-md mx-auto flex gap-4 items-center">
        <form action="" class="flex gap-4 items-center">
            <select id="tags" name="tags" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                <option value="" selected disabled>Sélectionnez un tag</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->slug }}" @selected(request()->query('tags') === $tag->slug)>{{ $tag->name }}</option>
                @endforeach
            </select>
            <x-secondary-button type="submit">Filtrer</x-secondary-button>
        </form>
        <a href="{{ route('messages.index') }}">Réinitialiser</a>
    </section>

    <section class="flex-1 w-full max-w-sm mx-auto py-12 flex flex-col gap-8">
        <div class="flex-1 flex flex-col justify-end gap-4 overflow-y-auto">
            @foreach($messages as $message)
                <article class="px-4 py-3 bg-white border shadow rounded-xl space-y-4">
                    <p>{{ $message->content }}</p>
                    <div class="flex gap-2 flex-wrap">
                        @foreach ($message->tags as $tag)
                            <span style="--color: #{{$tag->color}}" class="text-sm px-1 py-0 rounded-md bg-[--color] font-semibold">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div>
                        <p class="leading-none">{{ $message->user->name }}</p>
                        <time class="text-sm text-slate-500">{{ $message->published_at->diffForHumans() }}</time>
                    </div>
                </article>
            @endforeach
        </div>
        <form action="{{ route('messages.store') }}" method="post" class="px-4 py-3 bg-white border shadow rounded-xl space-y-2">
            @csrf

            <div>
                <x-input-label for="content" value="Votre message" />
                <textarea id="content" name="content" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('content')" />
            </div>
            <div>
                <x-input-label for="tags" value="Choisissez les tags" />
                <select id="tags" name="tags[]" multiple class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('tags')" />
            </div>
            <x-primary-button>Envoyer</x-primary-button>
        </form>
    </section>
</x-app-layout>
