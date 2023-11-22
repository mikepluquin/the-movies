<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use App\Traits\Livewire\WithMovie;
use Livewire\Component;

class Preview extends Component
{
    use WithMovie;

    public Movie $movie;

    public function render()
    {
        return view('livewire.movies.preview');
    }
}
