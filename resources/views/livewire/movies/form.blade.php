<div>
    {{-- Sync disabled warning --}}
    @if($movie->synchronization_enabled)
        <div class="bg-orange-200 text-orange-700 p-4 rounded w-fit mb-2 text-sm max-w-sm">
            {{ __('This movie has its synchronization activated: if you modify it, it will no longer be automatically synchronized daily.') }}
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white rounded shadow-md p-6">
        <form
            wire:submit.prevent="save"
            class="flex flex-col max-w-md gap-3"
        >
            {{-- Title --}}
            <div class="flex flex-col gap-1">
                <label class="font-bold">
                    {{ __('Title') }}*
                </label>
                <input
                    type="text"
                    wire:model="movie.title"
                    class="rounded border-indigo-300"
                >
                @error('movie.title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Description --}}
            <div class="flex flex-col gap-1">
                <label class="font-bold">
                    {{ __('Description') }}
                </label>
                <textarea
                    wire:model="movie.description"
                    class="rounded border-indigo-300"
                    rows="5"
                >
                </textarea>
                @error('movie.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            

            {{-- Categories --}}
            <div class="flex flex-col gap-1">
                <label class="font-bold">
                    {{ __('Categories') }}
                </label>
                @foreach($categories as $category)
                    <label>
                        <input
                            type="checkbox"
                            value="{{ $category->id }}"
                            class="text-sm rounded my-1 checked:bg-indigo-500"
                            wire:model="categories_ids"
                        >
                        {{ $category->name }}
                    </label>
                @endforeach
                @error('categories_ids') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Save --}}
            <button
                class="bg-indigo-500 hover:bg-indigo-700 duration-300 px-4 py-2 text-white rounded uppercase font-bold"
                type="submit"
            >
                {{-- Loading icon --}}
                <i
                    class="fa-solid fa-rotate mr-1"
                    wire:loading.delay
                ></i>

                {{ __('Save') }}
            </button>
        </form>
    </div>
</div>
