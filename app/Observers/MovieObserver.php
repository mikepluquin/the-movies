<?php

namespace App\Observers;

use App\Models\Movie;

class MovieObserver
{
    /**
     * Handle the Movie "deleting" event.
     *
     * @param  \App\Models\Movie  $movie
     * @return void
     */
    public function deleting(Movie $movie)
    {
        $movie->categories()->detach();
    }
}
