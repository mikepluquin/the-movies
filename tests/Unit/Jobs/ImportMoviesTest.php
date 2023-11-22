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
        $moviesCount = Movie::count();

        (new ImportMovies())->handle();

        foreach ($apiMovies as $apiMovie) {
            $this->assertDatabaseHas('movies', [
                'tmdb_id' => $apiMovie['id'],
                'title' => $apiMovie['title'],
                'description' => $apiMovie['overview'],
                'poster_path' => $apiMovie['poster_path'],
                'synchronized_at' => now(),
            ]);
        }
        $this->assertDatabaseCount('movies', $moviesCount + count($apiMovies));
    }
}
