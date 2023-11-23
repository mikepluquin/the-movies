<?php

namespace Tests\Unit\Models;

use App\Models\Movie;
use Tests\Mocks\API\TheMovie;
use Tests\TestCase;

class MovieTest extends TestCase
{
    public function testSynchronizeFromApiIdWhenNotExistingAlready(): void
    {
        $this->freezeTime();
        $count = Movie::count();
        $apiMovie = TheMovie::getMovie(872585);

        $movie = Movie::synchronizeFromApiId($apiMovie['id']);

        $this->assertEquals($movie->tmdb_id, $apiMovie['id']);
        $this->assertEquals($movie->title, $apiMovie['title']);
        $this->assertEquals($movie->tagline, $apiMovie['tagline']);
        $this->assertEquals($movie->description, $apiMovie['overview']);
        $this->assertEquals($movie->poster_path, $apiMovie['poster_path']);
        $this->assertEquals($movie->synchronized_at->format('d/m/y h:i:s'), now()->format('d/m/y h:i:s'));
        $this->assertEquals($movie->backdrop_path, $apiMovie['backdrop_path']);
        $this->assertEquals($movie->budget, $apiMovie['budget']);
        $this->assertEquals($movie->revenue, $apiMovie['revenue']);
        $this->assertEquals($movie->released_at->format('Y-m-d'), $apiMovie['release_date']);
        $this->assertEquals($movie->homepage_url, $apiMovie['homepage']);
        $this->assertEquals($movie->runtime, $apiMovie['runtime']);
        $this->assertEquals($movie->vote_average, $apiMovie['vote_average']);
        $this->assertEquals($movie->vote_count, $apiMovie['vote_count']);
        $this->assertDatabaseCount('movies', $count + 1);
    }

    public function testSynchronizeFromApiIdWhenExistingAlready(): void
    {
        $this->freezeTime();
        $apiMovie = TheMovie::getMovie(872585);
        Movie::factory()->create([
            'tmdb_id' => $apiMovie['id'],
        ]);
        $count = Movie::count();
        $movie = Movie::synchronizeFromApiId($apiMovie['id']);

        $this->assertEquals($movie->tmdb_id, $apiMovie['id']);
        $this->assertEquals($movie->title, $apiMovie['title']);
        $this->assertEquals($movie->tagline, $apiMovie['tagline']);
        $this->assertEquals($movie->description, $apiMovie['overview']);
        $this->assertEquals($movie->poster_path, $apiMovie['poster_path']);
        $this->assertEquals($movie->synchronized_at->format('d/m/y h:i:s'), now()->format('d/m/y h:i:s'));
        $this->assertEquals($movie->backdrop_path, $apiMovie['backdrop_path']);
        $this->assertEquals($movie->budget, $apiMovie['budget']);
        $this->assertEquals($movie->revenue, $apiMovie['revenue']);
        $this->assertEquals($movie->released_at->format('Y-m-d'), $apiMovie['release_date']);
        $this->assertEquals($movie->homepage_url, $apiMovie['homepage']);
        $this->assertEquals($movie->runtime, $apiMovie['runtime']);
        $this->assertEquals($movie->vote_average, $apiMovie['vote_average']);
        $this->assertEquals($movie->vote_count, $apiMovie['vote_count']);
        $this->assertDatabaseCount('movies', $count);
    }

    public function testNotSynchronizeFromApiIdWhenSynchronizationDisabled(): void
    {
        $this->freezeTime();
        $apiMovie = TheMovie::getMovie(872585);
        Movie::factory()->create([
            'tmdb_id' => $apiMovie['id'],
            'synchronization_enabled' => false,
        ]);
        $count = Movie::count();
        $movie = Movie::synchronizeFromApiId($apiMovie['id']);

        $this->assertNull($movie);
        $this->assertDatabaseCount('movies', $count);
    }

    public function testSynchronizeFromApiIdWhenIdNotFound(): void
    {
        $this->freezeTime();
        $count = Movie::count();

        $movie = Movie::synchronizeFromApiId(9999);

        $this->assertNull($movie);
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
