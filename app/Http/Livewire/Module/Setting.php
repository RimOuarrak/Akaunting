<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;
use App\Models\Module\Module;
class Setting extends Component
{
    public $module;
    public $enabled;

    public function mount($id)
    {
        $this->module = Module::find($id);
        $this->enabled = $this->module->enabled;
    }

    public function switch()
    {
        if ($this->enabled)
            $enabled = 0;
        else 
            $enabled = 1;
        $this->module->enabled = $enabled;
        $this->module->save();
        $this->enabled = $enabled;
        $this->dispatchBrowserEvent('refresh');
    }

    public function render()
    {
        return view('livewire.module.setting');
    }
}
