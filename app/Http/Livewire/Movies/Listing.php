<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function render()
    {
        return view('livewire.movies.listing', [
            'movies' => Movie::search($this->search)->paginate(6),
        ]);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
}
