<?php

namespace App\Traits\Livewire;

use App\Models\Movie;
use Illuminate\Support\Facades\Vite;

trait WithMovie
{
    public Movie $movie;

    /**
     * @param string $imageName Could be "poster", "backdrop"...
     * @param string $size
     *
     * @return string
     */
    public function getImageUrl(string $imageName, string $size = '200'): string
    {
        return $this->movie->getImageUrl($imageName, $size) ?? Vite::asset('resources/images/' . $imageName . '_placeholder.png');
    }
}
