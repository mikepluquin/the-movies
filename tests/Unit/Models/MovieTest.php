<?php

namespace Tests\Unit\Models;

use App\Models\Movie;
use Tests\Mocks\API\TheMovie;
use Tests\TestCase;

class MovieTest extends TestCase
{
    public function testSynchronizeFromApiWhenNotExistingAlready(): void
    {
        $this->freezeTime();

        $count = Movie::count();
        $apiMovie = TheMovie::getMovies()['results'][0];

        Movie::synchronizeFromApi($apiMovie);

        $this->assertDatabaseHas('movies', [
            'tmdb_id' => $apiMovie['id'],
            'title' => $apiMovie['title'],
            'description' => $apiMovie['overview'],
            'poster_path' => $apiMovie['poster_path'],
            'synchronized_at' => now(),
        ]);
        $this->assertDatabaseCount('movies', $count + 1);
    }

    public function testSynchronizeFromApiWhenExistingAlready(): void
    {
        $this->freezeTime();
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
            'synchronized_at' => now(),
        ]);
        $this->assertDatabaseCount('movies', $count);
    }

    public function testGetPosterUrlWhenPathPresent()
    {
        $movie = Movie::factory()->create([
            'poster_path' => 'johnwick.png',
        ]);

        $this->assertEquals(
            "https://image.tmdb.org/t/p/w500/johnwick.png",
            $movie->getPosterUrl(500),
        );
    }

    public function testGetPosterUrlWhenPathBlank()
    {
        $movie = Movie::factory()->create([
            'poster_path' => null,
        ]);

        $this->assertNull($movie->getPosterUrl(500));
    }
}
