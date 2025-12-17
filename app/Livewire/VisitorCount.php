<?php

namespace App\Livewire;

use App\Models\Visitors;
use Livewire\Component;

class VisitorCount extends Component
{
    public $count;

    public function mount()
    {
        $this->count = Visitors::count();
    }

    public function refresh()
    {
        $this->count = Visitors::count();
    }


    public function render()
    {
        return view('livewire.visitor-count');
    }
}
