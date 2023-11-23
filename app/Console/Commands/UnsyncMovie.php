<?php

namespace App\Console\Commands;

use App\Models\Movie;
use Illuminate\Console\Command;

class UnsyncMovie extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:unsynchronize {movie_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unsynchronize a movie';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $movie = Movie::find($this->argument('movie_id'));
        // Set sync date to more than a day ago, in order to able manual synchronization
        $movie->synchronized_at = now()->subDays(2);
        $movie->save();
    }
}
