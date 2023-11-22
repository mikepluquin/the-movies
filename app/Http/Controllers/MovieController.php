<?php

namespace App\Http\Controllers;

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
}
