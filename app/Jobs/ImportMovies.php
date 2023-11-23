<?php

namespace App\Jobs;

use App\Models\Movie;
use App\Services\API\TheMovie;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class ImportMovies implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        // Try to retrieve movies from API
        $apiResponse = app(TheMovie::class)->getMovies();

        if ($apiResponse) {
            $apiMovies = $apiResponse['results'] ?? [];

            // Pluck movies' ids
            $apiMoviesIds = Arr::pluck($apiMovies, 'id');

            // Synchronize each API's movie
            foreach ($apiMoviesIds as $apiMovieId) {
                Movie::synchronizeFromApiId($apiMovieId);
            }
        }
    }
}
