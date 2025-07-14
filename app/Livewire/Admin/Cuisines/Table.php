<?php

namespace App\Livewire\Admin\Cuisines;

use App\Models\Cuisine;
use Livewire\Component;

class Table extends Component
{
    public $cuisines;

    public function mount()
    {
        $this->cuisines = Cuisine::orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.cuisines.table');
    }
}
