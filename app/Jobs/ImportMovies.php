<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\API\TheMovie;
use App\Models\Movie;

class ImportMovies implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Try to retrieve movies from API
        $apiResponse = app(TheMovie::class)->getMovies();
        
        if (!is_null($apiResponse)) {
            $apiMovies = $apiResponse['results'] ?? [];

            // Synchronize each API's movie
            foreach ($apiMovies as $apiMovie) {
                Movie::synchronizeFromApi($apiMovie);
            }
        }
    }
}
