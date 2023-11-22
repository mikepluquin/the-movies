<?php

namespace Tests\Unit\Models;

use App\Models\Movie;
use Tests\Mocks\API\TheMovie;
use Tests\TestCase;

class MovieTest extends TestCase
{
    public function testSynchronizeFromApi(): void
    {
        $apiMovie = TheMovie::getMovies()['results'][0];

        Movie::synchronizeFromApi($apiMovie);

        $this->assertDatabaseHas('movies', [
            'tmdb_id' => $apiMovie['id'],
            'title' => $apiMovie['title'],
            'description' => $apiMovie['overview'],
            'poster_path' => $apiMovie['poster_path'],
        ]);
    }
}
