<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function testIndexSucceed(): void
    {
        $this->be(User::factory()->create());

        $response = $this->get('/movies');
        $response->assertOk();
    }

    public function testIndexNotAuthenticated(): void
    {
        $response = $this->get('/movies');
        $response->assertRedirect('/login');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function testShowSucceed(): void
    {
        $this->be(User::factory()->create());
        $movie = Movie::factory()->create();
        $response = $this->get('/movies/' . $movie->id);

        $response->assertOk();
    }

    public function testShowNotFound(): void
    {
        $this->be(User::factory()->create());
        $response = $this->get('/movies/99999');

        $response->assertNotFound();
    }

    public function testShowNotAuthenticated(): void
    {
        $movie = Movie::factory()->create();
        $response = $this->get('/movies/' . $movie->id);

        $response->assertRedirect('/login');
    }
}
