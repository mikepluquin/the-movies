<div class="space-y-4">
    @foreach ($movies as $movie)
        <div class="bg-white p-6 shadow-md rounded">
            {{-- Preview each movie --}}
            <livewire:movies.preview
                :movie="$movie"
            />
        </div>
    @endforeach

    {{-- Pagination --}}
    {{ $movies->links() }}
</div>
