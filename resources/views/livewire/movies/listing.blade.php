<div>
    {{-- Search --}}    
    <input
        wire:model="search"
        type="search"
        placeholder="{{ __('Search') }}"
        class="rounded border-none mb-4"
    >

    {{-- Loading --}}
    <i
        class="fa-solid fa-circle-notch fa-spin text-indigo-500 ml-2"
        wire:loading.delay
    ></i>

    {{-- Movies --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        @foreach ($movies as $movie)
            {{-- Preview each movie --}}
            <livewire:movies.preview
                :movie="$movie"
                :key="$movie->id"
            />
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-12">
        {{ $movies->links() }}
    </div>
</div>
