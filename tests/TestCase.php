<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\Mocks\API\TheMovie;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     *  Common setup for all tests
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->fakeHttpRequests();
    }

    /**
     * Fake HTTP requests
     *
     * @return void
     */
    protected function fakeHttpRequests(): void
    {
        Http::fake([
            // TMDB API
            'api.themoviedb.org/3/trending/movie/day' => Http::response(TheMovie::getMovies()),
            'api.themoviedb.org/3/movie/872585' => Http::response(TheMovie::getMovie(872585)),
            'api.themoviedb.org/3/movie/901362' => Http::response(TheMovie::getMovie(901362)),

            // Fake every other requests
            '*' => Http::response(),
        ]);
    }
}
