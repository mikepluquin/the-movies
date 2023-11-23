<?php

namespace App\Http\Livewire\Movies;

use App\Models\Category;
use App\Models\Movie;
use Livewire\Component;

class Form extends Component
{
    public Movie $movie;
    public $categories_ids;

    protected array $rules = [
        'movie.title' => 'required',
        'movie.description' => '',
        'categories_ids' => '',
    ];

    public function save()
    {
        $this->validate();

        $this->movie->synchronization_enabled = false; // Disable sync on manual update
        $this->movie->save();
        $this->movie->categories()->sync($this->categories_ids);

        redirect()
            ->route('movies.show', ['movie' => $this->movie->id])
            ->with('success', __('Movie successfully updated.'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        // Set default values based on movie's relations
        $this->categories_ids = $this->movie->categories()->pluck('categories.id');
    }

    public function render()
    {
        return view('livewire.movies.form', [
            'categories' => Category::all(),
        ]);
    }
}
