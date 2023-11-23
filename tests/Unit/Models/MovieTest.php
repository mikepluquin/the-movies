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
        $apiMovie = TheMovie::getMovie(872585);

        Movie::synchronizeFromApi($apiMovie['id']);

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
        $apiMovie = TheMovie::getMovie(872585);

        Movie::factory()->create([
            'tmdb_id' => $apiMovie['id'],
        ]);
        $count = Movie::count();

        Movie::synchronizeFromApi($apiMovie['id']);

        $this->assertDatabaseHas('movies', [
            'tmdb_id' => $apiMovie['id'],
            'title' => $apiMovie['title'],
            'tagline' => $apiMovie['tagline'],
            'description' => $apiMovie['overview'],
            'poster_path' => $apiMovie['poster_path'],
            'synchronized_at' => now(),
            'backdrop_path' => $apiMovie['backdrop_path'],
            'budget' => $apiMovie['budget'],
            'revenue' => $apiMovie['revenue'],
            'released_at' => $apiMovie['release_date'],
            'homepage_url' => $apiMovie['homepage'],
            'runtime' => $apiMovie['runtime'],
            'poster_path' => $apiMovie['poster_path'],
        ]);
        $this->assertDatabaseCount('movies', $count);
    }

    public function testGetImageUrlWhenPathPresent()
    {
        $movie = Movie::factory()->create([
            'poster_path' => '/johnwick.png',
        ]);

        $this->assertEquals(
            "https://image.tmdb.org/t/p/w500/johnwick.png",
            $movie->getImageUrl('poster', '500'),
        );
    }

    public function testGetImageUrlWhenPathBlank()
    {
        $movie = Movie::factory()->create([
            'poster_path' => null,
        ]);

        $this->assertNull($movie->getImageUrl('poster', '500'));
    }

    public function testGetImageUrlWhenAttributeNotExists()
    {
        $movie = Movie::factory()->create();

        $this->assertNull($movie->getImageUrl('logo', '500'));
    }
}
