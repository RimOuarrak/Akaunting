<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;
use App\Models\Module\Module;
class Index extends Component
{
    protected $items = [];

    public function mount()
    {
        $this->items = Module::all();
    }
    public function render()
    {
        return view('livewire.module.index' ,['items' => $this->items]);
    }
}
