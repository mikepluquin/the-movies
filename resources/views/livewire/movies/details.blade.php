<div>
    <div class="bg-white p-8 overflow-hidden shadow-md sm:rounded-lg my-4">
        <div>
            <div class="flex gap-6">
                {{-- Poster --}}
                <img
                    src="{{ $this->getPosterUrl() }}"
                    alt="{{ $movie->title }}"
                    class="rounded"
                />

                {{-- Description --}}
                <div>
                    @if(!is_null($movie->description))
                        <h3 class="font-bold text-xl">
                            {{ __('Synopsis') }}
                        </h3>

                        <p class="mt-4">
                            {{ $movie->description }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
