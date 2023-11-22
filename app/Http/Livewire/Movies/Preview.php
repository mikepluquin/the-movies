<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use Illuminate\Support\Facades\Vite;
use Livewire\Component;

class Preview extends Component
{
    public Movie $movie;

    public function render()
    {
        return view('livewire.movies.preview');
    }

    /**
     * @param int $size
     *
     * @return string
     */
    public function getPosterUrl(int $size = 200): string
    {
        return $this->movie->getPosterUrl($size) ?? Vite::asset('resources/images/poster_placeholder.png');
    }
}
