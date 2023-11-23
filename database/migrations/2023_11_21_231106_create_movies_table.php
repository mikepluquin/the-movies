<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table): void {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->boolean('synchronization_enabled')->default(true);
            $table->integer('tmdb_id');
            $table->string('tagline')->nullable();
            $table->integer('budget')->nullable();
            $table->integer('revenue')->nullable();
            $table->integer('runtime')->nullable();
            $table->string('homepage_url')->nullable();
            $table->integer('vote_count')->nullable();
            $table->float('vote_average')->nullable();
            $table->datetime('released_at')->nullable();
            $table->datetime('synchronized_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
