<x-app-layout>
    <x-slot name="header">
        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            ← Retour
        </a>
    </x-slot>

    <div class="container mx-auto py-8">
        <section class="grid grid-cols-[1fr] items-start gap-8">
            <article class="space-y-4 top-8">
                <h1 class="text-3xl leading-none tracking-tight font-bold">{{ $distributor->nom }}</h1>
                <p class="font-semibold text-gray-400">{{ $distributor->telephone }}</p>
            </article>
            <article class="bg-white rounded-2xl p-4 shadow-lg w-full min-w-0">
                <h2 class="mb-4 text-xl font-semibold">Films du même distributeur</h2>
                <ul class="grid grid-flow-col auto-cols-max gap-4 overflow-x-auto snap-x snap-proximity">
                    @foreach ($movies as $movie)
                        <li class="group relative rounded-2xl overflow-hidden w-[200px] snap-center">
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
                                @if ($movie->distributor)
                                    <p>Distribué par : {{ $movie->distributor->nom }}</p>
                                @endif
                            </div>
                            <a href="{{ route('movies.show', ['movie' => $movie]) }}" class="absolute inset-0"></a>
                        </li>
                    @endforeach
                </ul>
            </article>
        </section>
    </div>
</x-app-layout>
