<?php

namespace App\Models;

use App\Services\API\TheMovie;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;

class Movie extends Model
{
    use Searchable;
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'synchronized_at' => 'datetime',
        'released_at' => 'datetime',
        'vote_average' => 'float',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'synchronization_enabled' => true, // Synchronize automatically movie from API
    ];

     /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'tagline' => $this->tagline,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * A movie belongs to many categories
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | GETTERS
    |--------------------------------------------------------------------------
    */

    /**
     * Build full poster image's URL
     * See: https://developer.themoviedb.org/docs/image-basics
     *
     * @param string $imageName Could be "poster", "backdrop"...
     * @param string $size
     *
     * @return string|null
     */
    public function getImageUrl(string $imageName, string $size = '200'): ?string
    {
        $imagesNames = [
            'poster',
            'backdrop',
        ];

        // Make sure that a valid image name is provided
        if (in_array($imageName, $imagesNames)) {
            // Build image attribute's name
            $imageAttributeName = $imageName . '_path';

            // Check if image attribute exists
            if (
                !is_null($this->{$imageAttributeName})
            ) {
                // Build image's url
                return "https://image.tmdb.org/t/p/"
                    . "w" . $size
                    . $this->{$imageAttributeName};
            }
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
     * @return Movie|null
     */
    public static function synchronizeFromApiId(int $apiMovieId): ?Movie
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
            $movie->tagline = $apiMovie['tagline'] ?? null;
            $movie->description = $apiMovie['overview'] ?? null;
            $movie->poster_path = $apiMovie['poster_path'] ?? null;
            $movie->backdrop_path = $apiMovie['backdrop_path'] ?? null;
            $movie->budget = $apiMovie['budget'] ?? null;
            $movie->revenue = $apiMovie['revenue'] ?? null;
            $movie->released_at = $apiMovie['release_date'] ?? null;
            $movie->homepage_url = $apiMovie['homepage'] ?? null;
            $movie->runtime = $apiMovie['runtime'] ?? null;
            $movie->vote_count = $apiMovie['vote_count'] ?? null;
            $movie->vote_average = $apiMovie['vote_average'] ?? null;

            // Save synchronized movie
            $movie->save();

            // Assign relations
            $categories = Arr::map($apiMovie['genres'] ?? [], function ($apiCategory) {
                return Category::synchronizeFromApiData($apiCategory);
            });
            $categoriesIds = Arr::pluck($categories, 'id');
            $movie->categories()->sync($categoriesIds);

            return $movie;
        }

        return null;
    }
}
