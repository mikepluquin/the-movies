<?php

namespace Tests\Unit\Observers;

use App\Models\Category;
use App\Models\Movie;
use App\Observers\MovieObserver;
use Tests\TestCase;

class MovieObserverTest extends TestCase
{
    protected Movie $movie;

    protected MovieObserver $movieObserver;

    protected function setUp(): void
    {
        parent::setUp();

        $this->movie = Movie::factory()->createQuietly();
        $this->movieObserver = new MovieObserver();
    }

    public function testDetachCategoriesOnDeleted(): void
    {
        $category = Category::factory()->create();
        $this->movie->categories()->attach($category->id);

        $this->movieObserver->deleting($this->movie);

        $this->assertEmpty($category->movies);
        $this->assertModelExists($category);
    }
}
