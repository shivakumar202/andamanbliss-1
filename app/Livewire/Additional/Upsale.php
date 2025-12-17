<?php

namespace App\Livewire\Additional;

use Livewire\Component;

class Upsale extends Component
{
    public $step = 0;
    public $totalSteps = 2;
    public $adult = 1;
    public $infant = 0;

    public function mount()
    {
        if(now()->greaterThan(session('time_out'))) {
            session()->forget(['time_out','current_step']);
        }
        $this->step = session()->get('current_step');
    }

    public function addActivity($id)
    {
        dd($id);
    }

    public function nextStep()
    {
        $this->step+= 1;
        session()->put('time_out',now()->addMinutes(1));
        session()->put('current_step',$this->step);
    }

    public function render()
    {
        return view('livewire.additional.upsale');
    }
}
