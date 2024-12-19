<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Films') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8">
        <div class="grid grid-cols-[1fr,minmax(20rem,max-content)] gap-8 items-start">
            <div class="grid grid-cols-3 gap-6">
                @foreach ($movies as $movie)
                    <article class="group relative rounded-2xl overflow-hidden">
                        @if ($movie->poster)
                            <img src="{{ $movie->poster }}" alt="" class="w-full h-full filter group-hover:brightness-50 transition-all duration-200">
                        @else
                            <div class="size-full bg-gray-300 flex items-center justify-center p-6 filter group-hover:brightness-50 transition-all duration-200">
                                <p class="text-2xl font-bold text-center">{{ $movie->titre }}</p>
                            </div>
                        @endif
                        <div class="absolute rounded-2xl w-full h-2/3 -bottom-2/3 bg-white/80 backdrop-blur-md group-hover:bottom-0 transition-all duration-200 px-5 py-4 shadow-xl space-y-4">
                            <h1 class="text-2xl font-bold leading-none">{{ $movie->titre }}</h1>
                            @if ($movie->type)
                                <p>{{ $movie->type->nom }}</p>
                            @endif
                            @if ($movie->annee_production)
                                <p>{{ $movie->annee_production }}</p>
                            @endif
                            @if ($movie->distributor)
                                <p>Distribué par : {{ $movie->distributor->nom }}</p>
                            @endif
                        </div>
                        <a href="{{ route('movies.show', ['movie' => $movie]) }}" class="absolute inset-0"></a>
                    </article>
                @endforeach

                <div class="col-span-full">
                    {{ $movies->onEachSide(0)->links() }}
                </div>
            </div>

            <aside class="bg-white shadow-lg rounded-2xl p-6 sticky top-8">
                <form class="space-y-4">
                    <div class="flex items-center gap-4">
                        <x-secondary-button type="submit">Filtrer</x-secondary-button>
                        @if (request()->has('types'))
                            <a href="{{ route('movies.index') }}">Réinitialiser</a>
                        @endif
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-2 mb-2">
                            <h2 class="text-lg font-semibold">Genre</h2>
                            <a href="{{ route('movies.index', ['types' => $types->pluck('id_genre')->toArray()]) }}" class="text-sm">Tout sélectionner</a>
                        </div>
                            @foreach ($types as $type)
                                <x-input-label>
                                    <input type="checkbox" name="types[]" value="{{ $type->id_genre }}" @checked(in_array($type->id_genre, request()->query('types', [])))>
                                    <span class="ml-1">
                                        {{ $type->nom }}
                                    </span>
                                </x-input-label>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <x-secondary-button type="submit">Filtrer</x-secondary-button>
                        @if (request()->has('types'))
                            <a href="{{ route('movies.index') }}">Réinitialiser</a>
                        @endif
                    </div>
                </form>
            </aside>
        </div>
    </div>
</x-app-layout>
