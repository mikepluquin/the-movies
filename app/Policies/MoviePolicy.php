<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;

class MoviePolicy
{
    /**
     * Determine whether the user can synchronize the resource.
     *
     * @param User $user
     * @param Movie $movie
     *
     * @return bool
     */
    public function synchronize(User $user, Movie $movie): bool
    {
        // Movie can only be synchronized once per day
        return is_null($movie->synchronized_at) || $movie->synchronized_at < now()->subDay();
    }
}
