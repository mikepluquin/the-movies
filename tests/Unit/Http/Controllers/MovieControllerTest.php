<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\User;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
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
}
