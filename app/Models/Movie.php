<?php

namespace App\Models;

use App\Services\API\TheMovie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'synchronized_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'synchronization_enabled' => true, // Synchronize automatically movie from API
    ];


    /*
    |--------------------------------------------------------------------------
    | GETTERS
    |--------------------------------------------------------------------------
    */

    /**
     * Build full poster image's URL
     * See: https://developer.themoviedb.org/docs/image-basics
     *
     * @param int $size
     *
     * @return string|null
     */
    public function getPosterUrl($size = 200): ?string
    {
        if (!is_null($this->poster_path)) {
            return "https://image.tmdb.org/t/p/"
                . "w" . $size
                . $this->poster_path;
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESSING
    |--------------------------------------------------------------------------
    */

    /**
     * Create or update a movie from API
     *
     * @param int $apiMovieId
     *
     * @return void
     */
    public static function synchronizeFromApi(int $apiMovieId): void
    {
        // Retrieve movie from API
        $apiMovie = app(TheMovie::class)->getMovie($apiMovieId);

        if (!is_null($apiMovie)) {
            // Find or init the movie to synchronize
            $movie = Movie::where('tmdb_id', $apiMovieId)->first() ?? new Movie();

            // Assign attributes
            $movie->tmdb_id = $apiMovieId;
            $movie->title = $apiMovie['title'];
            $movie->synchronized_at = now();
            // Use coalescent operator to allow nullable attributes
            $movie->description = $apiMovie['overview'] ?? null;
            $movie->poster_path = $apiMovie['poster_path'] ?? null;

            // Save synchronized movie
            $movie->save();
        }
    }
}
