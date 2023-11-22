<x-app-layout>
    {{-- Header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $movie->title }}
        </h2>
    </x-slot>

    {{-- Details --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:movies.details
                :movie="$movie"
            />
        </div>
    </div>
</x-app-layout>
