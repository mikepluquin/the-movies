<div>
    <div
        class="bg-white text-white rounded shadow-md bg-cover bg-center overflow-hidden"
        style="background-image: url({{ $this->getImageUrl('backdrop', '1920_and_h800_multi_faces') }});"
    >
        <div
            class="backdrop-brightness-[0.4] backdrop-grayscale-[0.3] backdrop-blur-[5px]"
        >
            <div class="flex gap-6 p-6">
                {{-- Poster --}}
                <img
                    src="{{ $this->getImageUrl('poster', '300') }}"
                    alt="{{ $movie->title }}"
                    class="rounded"
                    width="300"
                />

                <div class="flex flex-col justify-between">
                    {{-- Main details --}}
                    <div>
                        {{-- Title & tagline --}}
                        <h2 class="text-3xl font-bold mb-1">
                            {{ $movie->title }}
                        </h2>
                        @if(!is_null($movie->description))
                            <h3 class="mb-1 italic text-gray-200">
                                {{ $movie->tagline }}
                            </h3>
                        @endif

                        {{-- Duration --}}
                        @if(!is_null($movie->runtime))
                            <p class="mb-1 text-sm">
                                {{ Carbon\CarbonInterval::minutes($movie->runtime)->cascade()->forHumans() }}
                            </p>
                        @endif

                        {{-- Vote --}}
                        @if(!is_null($movie->vote_average))
                            <div class="flex items-center">
                                <div class="w-24 h-2 bg-white rounded overflow-hidden mr-2">
                                    <div
                                        class="bg-green-500 h-full"
                                        style="width: {{ $movie->vote_average * 10 }}%"
                                    >
                                    </div>
                                </div>

                                <span class="text-sm">
                                    &bull;
                                    {{ $movie->vote_average }} / 10
                                    @if(!is_null($movie->vote_count))
                                        <span class="text-xs">
                                            ({{ number_format($movie->vote_count, 0, '.', ',') . __(' votes') }})
                                        </span>
                                    @endif
                                </span>
                            </div>
                        @endif

                        @if(!is_null($movie->released_at))
                            <p class="mt-2">
                                {{ $movie->released_at->format('F d, Y') }}
                            </p>
                        @endif

                        {{-- Description --}}
                        @if(!is_null($movie->description))
                            <h4 class="font-bold text-xl mt-4">
                                {{ __('Synopsis') }}
                            </h4>

                            <p class="mt-2">
                                {{ $movie->description }}
                            </p>
                        @endif
                    </div>


                    {{-- Minor details --}}
                    <div>
                        {{-- Budget & revenue --}}
                        @if(!is_null($movie->budget))
                            <p class="text-sm">
                                {{ __('Budget: $') . number_format($movie->budget, 0, '.', ',') }}
                            </p>
                        @endif
                        @if(!is_null($movie->revenue))
                            <p class="text-sm">
                                {{ __('Revenue: $') . number_format($movie->revenue, 0, '.', ',') }}
                            </p>
                        @endif

                        {{-- Homepage URL --}}
                        @if(!is_null($movie->homepage_url))
                            <a
                                href="{{ $movie->homepage_url }}"
                                target="_blank"
                                class="font-bold block mt-4"
                            >
                                {{ __('See official website') }}
                            </a>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="self-end">
                        <button
                            class="bg-red-500 hover:bg-red-700 duration-300 px-4 py-2 text-white rounded uppercase font-bold"
                            wire:click="delete"
                            wire:loading.attr="disabled"
                        >
                            {{-- Trash icon --}}
                            <i
                                class="fa-solid fa-trash mr-1"
                                wire:loading.class="hidden"
                            ></i>

                            {{-- Loading icon --}}
                            <i
                                class="fa-solid fa-circle-notch fa-spin mr-1"
                                wire:loading
                            ></i>

                            {{ __('Delete' )}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
