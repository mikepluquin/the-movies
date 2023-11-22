<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Listing extends Component
{
    public Collection $movies;

    public function render()
    {
        $this->movies = Movie::all();
        return view('livewire.movies.listing');
    }
}
