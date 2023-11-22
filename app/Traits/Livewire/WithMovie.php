<?php

namespace App\Traits\Livewire;

use App\Models\Movie;
use Illuminate\Support\Facades\Vite;

trait WithMovie
{
    public Movie $movie;

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
