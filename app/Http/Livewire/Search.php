<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Search extends Component
{
    public string $searchString = '';

    public function updatedSearchString()
    {
        $this->emit('searchUpdated', $this->searchString);
    }

    public function render()
    {
        return view('livewire.search');
    }
}
