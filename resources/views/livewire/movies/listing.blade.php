<div>
    @foreach ($movies as $movie)
        <div class="bg-white p-8 overflow-hidden shadow-md sm:rounded-lg my-4">
            {{-- Preview each movie --}}
            <livewire:movies.preview
                :movie="$movie"
            />
        </div>
    @endforeach
</div>
