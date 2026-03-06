<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Home | Qatar National Library')]
class Dashboard extends Component
{
    public function render()
    {
        return view('dashboard');
    }
}
