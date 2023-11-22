<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'synchronization_enabled' => true, // Synchronize automatically movie from API
    ];

    /**
     * Create or update a movie from API
     *
     * @param array $apiMovie
     *
     * @return void
     */
    public static function synchronizeFromApi(array $apiMovie): void
    {
        // Retrieve TMDB id
        $tdmbId = $apiMovie['id'];

        // Find or init the movie to synchronize
        $movie = Movie::where('tmdb_id', $tdmbId)->first() ?? new Movie();

        // Assign attributes
        $movie->tmdb_id = $tdmbId;
        $movie->title = $apiMovie['title'];
        // Use coalescent operator to allow nullable attributes
        $movie->description = $apiMovie['overview'] ?? null;
        $movie->poster_path = $apiMovie['poster_path'] ?? null;

        // Save synchronized movie
        $movie->save();
    }
}
