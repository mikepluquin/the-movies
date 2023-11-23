<?php

namespace Tests\Unit\Policies;

use App\Models\Movie;
use App\Models\User;
use Tests\Mocks\API\TheMovie;
use Tests\TestCase;

class MoviePolicyTest extends TestCase
{
    protected Movie $movie;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->movie = Movie::factory()->create();
        $this->user = User::factory()->create();
    }

    public function testCanSynchronizeWhenNeverDone(): void
    {
        $this->movie->synchronized_at = null;
        $this->assertTrue($this->user->can('synchronize', $this->movie));
    }

    public function testCanSynchronizeWhenDoneMoreThanADayAgo(): void
    {
        $this->movie->synchronized_at = now()->subDay()->subHour();
        $this->assertTrue($this->user->can('synchronize', $this->movie));
    }

    public function testCannotSynchronizeWhenDoneToday(): void
    {
        $this->movie->synchronized_at = now()->subHour();
        $this->assertFalse($this->user->can('synchronize', $this->movie));
    }
}
