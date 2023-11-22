<div>
    {{-- Search --}}    
    <input
        wire:model="search"
        type="search"
        placeholder="{{ __('Search') }}"
        class="rounded border-none mb-4"
    >

    {{-- Movies --}}
    <div class="space-y-4">
        @foreach ($movies as $movie)
            <div class="bg-white p-6 shadow-md rounded">
                {{-- Preview each movie --}}
                <livewire:movies.preview
                    :movie="$movie"
                    :key="$movie->id"
                />
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $movies->links() }}
    </div>
</div>
