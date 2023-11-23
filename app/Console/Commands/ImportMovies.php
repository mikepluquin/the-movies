<?php

namespace App\Console\Commands;

use App\Jobs\ImportMovies as JobsImportMovies;
use Illuminate\Console\Command;

class ImportMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import movies to database fetching TheMovieDatabase\'s API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        JobsImportMovies::dispatch();
    }
}
