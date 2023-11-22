<?php

namespace Tests\Unit\Models;

use App\Models\Movie;
use Tests\Mocks\API\TheMovie;
use Tests\TestCase;

class MovieTest extends TestCase
{
    public function testSynchronizeFromApiWhenNotExistingAlready(): void
    {
        $count = Movie::count();
        $apiMovie = TheMovie::getMovies()['results'][0];

        Movie::synchronizeFromApi($apiMovie);

        $this->assertDatabaseHas('movies', [
            'tmdb_id' => $apiMovie['id'],
            'title' => $apiMovie['title'],
            'description' => $apiMovie['overview'],
            'poster_path' => $apiMovie['poster_path'],
        ]);
        $this->assertDatabaseCount('movies', $count + 1);
    }

    public function testSynchronizeFromApiWhenExistingAlready(): void
    {
        $apiMovie = TheMovie::getMovies()['results'][0];

        Movie::factory()->create([
            'tmdb_id' => $apiMovie['id'],
        ]);
        $count = Movie::count();

        Movie::synchronizeFromApi($apiMovie);

        $this->assertDatabaseHas('movies', [
            'tmdb_id' => $apiMovie['id'],
            'title' => $apiMovie['title'],
            'description' => $apiMovie['overview'],
            'poster_path' => $apiMovie['poster_path'],
        ]);
        $this->assertDatabaseCount('movies', $count);
    }
}
