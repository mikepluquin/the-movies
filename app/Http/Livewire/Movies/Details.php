<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use App\Traits\Livewire\WithMovie;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Details extends Component
{
    use WithMovie;
    use AuthorizesRequests;

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

    /**
     * @return void
     */
    public function synchronize(): void
    {
        $this->authorize('synchronize', $this->movie);

        Movie::synchronizeFromApi($this->movie->tmdb_id);

        session()->flash('success', __('Movie successfully synchronized.'));

        redirect()->route('movies.show', ['movie' => $this->movie->id]);
    }
}
