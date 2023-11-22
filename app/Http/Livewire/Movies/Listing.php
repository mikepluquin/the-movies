<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use Livewire\Component;

class Listing extends Component
{
    public function render()
    {
        return view('livewire.movies.listing', [
            'movies' => Movie::paginate(5),
        ]);
    }
}
