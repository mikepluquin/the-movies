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

    public function testIndexSucceed()
    {
        $this->be(User::factory()->create());

        $response = $this->get('/movies');
        $response->assertOk();
    }

    public function testIndexNotAuthenticated()
    {
        $response = $this->get('/movies');
        $response->assertRedirect('/login');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function testShowSucceed()
    {
        $this->be(User::factory()->create());
        $movie = Movie::factory()->create();
        $response = $this->get('/movies/' . $movie->id);

        $response->assertOk();
    }

    public function testShowNotFound()
    {
        $this->be(User::factory()->create());
        $response = $this->get('/movies/99999');

        $response->assertNotFound();
    }

    public function testShowNotAuthenticated()
    {
        $movie = Movie::factory()->create();
        $response = $this->get('/movies/' . $movie->id);

        $response->assertRedirect('/login');
    }
}
