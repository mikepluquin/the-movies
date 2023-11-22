<div>
    <div class="bg-white p-6 rounded shadow-md">
        <div>
            <div class="flex gap-6">
                {{-- Poster --}}
                <img
                    src="{{ $this->getPosterUrl(300) }}"
                    alt="{{ $movie->title }}"
                    class="rounded"
                    width="300"
                />

                <div class="flex flex-col justify-between">
                    {{-- Details --}}
                    <div>
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

                    {{-- Actions --}}
                    <div class="self-end">
                        <button
                            class="bg-red-500 hover:bg-red-700 duration-300 px-4 py-2 text-white rounded uppercase font-bold"
                            wire:click="delete"
                        >
                            {{ __('Delete' )}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
