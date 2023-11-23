<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use App\Traits\Livewire\WithMovie;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Details extends Component
{
    use AuthorizesRequests;
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

        redirect()
            ->route('movies.index')
            ->with('success', __('Movie successfully deleted.'));
    }

    /**
     * @return void
     */
    public function synchronize(): void
    {
        $this->authorize('synchronize', $this->movie);

        $this->movie->update(['synchronization_enabled' => true]);
        Movie::synchronizeFromApiId($this->movie->tmdb_id);

        redirect()
            ->route('movies.show', ['movie' => $this->movie->id])
            ->with('success', __('Movie successfully synchronized.'));
    }
}
