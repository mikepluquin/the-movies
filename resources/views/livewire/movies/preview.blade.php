<a
    href="{{ route('movies.show', ['movie' => $movie->id] )}}"
>
    {{-- Poster --}}
    <div
        class="rounded shadow-md bg-cover bg-center w-full h-48 md:h-64 lg:h-72"
        style="background-image: url('{{ $this->getImageUrl('poster', 400) }}')"
    >
    </div>
    {{-- Title --}}
    <h3 class="text-center mt-2 font-bold text-lg">
        {{ $movie->title }}
    </h3>
</a>
