<x-app-layout>
    <x-slot name="header">
        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
            ← Retour
        </a>
    </x-slot>

    <div class="container mx-auto py-8">
        <section class="grid grid-cols-[1fr,1fr,16rem] items-start gap-8">
            <div class="rounded-2xl sticky top-8 overflow-hidden shadow-xl">
                @if ($movie->poster)
                    <img src="{{ $movie->poster }}" alt=""
                        class="w-full h-full filter group-hover:brightness-50 transition-all duration-200">
                @else
                    <div
                        class="aspect-[3/4] w-full bg-gray-300 flex items-center justify-center p-6 filter group-hover:brightness-50 transition-all duration-200">
                        <p class="text-2xl font-bold text-center">{{ $movie->titre }}</p>
                    </div>
                @endif
            </div>
            <article class="space-y-4 sticky top-8">
                <h1 class="text-3xl leading-none tracking-tight font-bold">{{ $movie->titre }}</h1>
                <p class="font-semibold text-gray-400">{{ $movie->annee_production }}</p>
                <p>{{ $movie->resum }}</p>
                @if ($movie->type)
                    <p>{{ $movie->type->nom }}</p>
                @endif
                @if ($movie->distributor)
                    <p>Distribué par : <a href="{{ route('distributors.show', ['distributor' => $movie->id_distributeur]) }}">{{ $movie->distributor->nom }}</a></p>
                @endif
            </article>
            <aside class="bg-white rounded-2xl p-4 shadow-lg">
                <h2 class="mb-4 text-xl font-semibold">Dans le même genre</h2>
                <ul class="flex flex-col gap-4">
                    @foreach ($recommandations as $movie)
                        <li class="relative flex gap-4 p-2 hover:bg-gray-100 rounded-xl">
                            <div class="w-1/3 rounded-md overflow-hidden">
                                @if ($movie->poster)
                                    <img src="{{ $movie->poster }}" alt=""
                                        class="rounded-md w-full h-full filter group-hover:brightness-50 transition-all duration-200">
                                @else
                                    <div
                                        class="rounded-md w-full aspect-[3/4] bg-gray-300 flex items-center justify-center p-6 filter group-hover:brightness-50 transition-all duration-200">
                                        <p class="text-sm font-bold text-center">{{ $movie->titre }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 space-y-2">
                                <h3 class="text-lg font-semibold leading-none tracking-wide">{{ $movie->titre }}</h3>
                                <p>{{ Str::limit($movie->resum, 30) }}</p>
                            </div>
                            <a href="{{ route('movies.show', ['movie' => $movie]) }}" class="absolute inset-0"></a>
                        </li>
                    @endforeach
                </ul>
            </aside>
        </section>
    </div>
</x-app-layout>
