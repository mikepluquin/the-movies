<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\View\View;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Movie $movie
     *
     * @return View
     */
    public function show(Movie $movie): View
    {
        return view('movies.show', [
            'movie' => $movie,
        ]);
    }
}
