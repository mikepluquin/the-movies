<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public string $search = "";

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function render()
    {
        $query = Movie::query();

        // Search by keywords if present
        if (!empty($this->search)) {
            $query->where('title', 'ilike', '%' . $this->search . '%');
        }

        return view('livewire.movies.listing', [
            'movies' => $query->paginate(5),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
