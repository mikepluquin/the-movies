<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use App\Traits\Livewire\WithMovie;
use Livewire\Component;

class Details extends Component
{
    use WithMovie;

    public Movie $movie;

    public function render()
    {
        return view('livewire.movies.details');
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $this->movie->delete();

        session()->flash('success', __('Movie successfully deleted.'));

        redirect()->route('movies.index');
    }

}
