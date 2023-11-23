<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * A category belongs to many movies
     */
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }

    /*
    |--------------------------------------------------------------------------
    | PROCESSING
    |--------------------------------------------------------------------------
    */

    /**
     * Create or update a category from API
     *
     * @param array $apiCategory
     *
     * @return Category
     */
    public static function synchronizeFromApiData(array $apiCategory): self
    {
        $tmdbId = $apiCategory['id'];

        // Find or init the category to synchronize
        $category = self::where('tmdb_id', $tmdbId)->first() ?? new self();

        // Assign attributes
        $category->tmdb_id = $tmdbId;
        $category->name = $apiCategory['name'];

        // Save synchronized category
        $category->save();

        return $category;
    }
}
