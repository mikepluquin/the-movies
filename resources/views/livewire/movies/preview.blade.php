<div>
    {{-- Summary --}}
    <div class="flex gap-6">
        {{-- Poster --}}
        <img
            src="{{ $this->getPosterUrl() }}"
            alt="{{ $movie->title }}"
            class="h-32 max-w-[5rem] rounded"
        />

        <div>
            {{-- Title --}}
            <h3 class="font-bold text-xl">
                {{ $movie->title }}
            </h3>

            {{-- Description --}}
            @if(!is_null($movie->description))
                <p class="mt-4">
                    {{ Str::limit($movie->description, 200) }}
                </p>
            @endif

            {{-- See details --}}
            <button class="mt-4 text-indigo-500 font-bold">
                {{ __('See details') }}
            </button>
        </div>
    </div>
</div>