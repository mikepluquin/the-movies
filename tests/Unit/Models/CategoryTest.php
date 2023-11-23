<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Tests\Mocks\API\TheMovie;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testSynchronizeFromApiDataWhenNotExistingAlready(): void
    {
        $count = Category::count();
        $apiCategory = TheMovie::getMovie(872585)['genres'][0];

        $category = Category::synchronizeFromApiData($apiCategory);

        $this->assertEquals($apiCategory['id'], $category->tmdb_id);
        $this->assertEquals($apiCategory['name'], $category->name);
        $this->assertDatabaseCount('categories', $count + 1);
    }

    public function testSynchronizeFromApiDataWhenExistingAlready(): void
    {
        $apiCategory = TheMovie::getMovie(872585)['genres'][0];

        Category::factory()->create([
            'tmdb_id' => $apiCategory['id'],
        ]);
        $count = Category::count();

        $category = Category::synchronizeFromApiData($apiCategory);

        $this->assertEquals($apiCategory['id'], $category->tmdb_id);
        $this->assertEquals($apiCategory['name'], $category->name);
        $this->assertDatabaseCount('categories', $count);
    }
}
