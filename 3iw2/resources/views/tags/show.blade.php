<x-app-layout>
    <x-slot name="header">
        <div class="flex items-start justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $tag->name }}
                </h2>
                <p class="text-gray-400">{{ $tag->slug }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('tags.edit', ['tag' => $tag]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    ✏️ Modifier
                </a>
                <form action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <x-danger-button>🗑️ Supprimer</x-danger-button>
                </form>
            </div>
        </div>
    </x-slot>

    {{-- @if (session()->has('success')) --}}
    @session('success')
        <div class="fixed bottom-8 right-8 inline-flex bg-green-100 text-green-900 px-4 py-2.5 rounded-md">
            {{ session()->get('success') }}
        </div>
    @endsession
</x-app-layout>
