<?php

namespace Tests\Unit\Jobs;

use App\Jobs\ImportMovies;
use App\Models\Movie;
use Tests\Mocks\API\TheMovie;
use Tests\TestCase;

class ImportMoviesTest extends TestCase
{
    public function testSynchronizeFromApi(): void
    {
        $this->freezeTime();

        $apiMovies = TheMovie::getMovies()['results'];
        $randomMovie = TheMovie::getMovie(872585);

        (new ImportMovies())->handle();

        $this->assertDatabaseHas('movies', [
            'tmdb_id' => $randomMovie['id'],
            'title' => $randomMovie['title'],
            'description' => $randomMovie['overview'],
            'poster_path' => $randomMovie['poster_path'],
            'synchronized_at' => now(),
        ]);
        $this->assertDatabaseCount('movies', count($apiMovies));
    }
}
