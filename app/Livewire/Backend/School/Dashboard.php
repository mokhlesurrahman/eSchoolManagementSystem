<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use Livewire\Attributes\Title;

class Dashboard extends Component
{
    #[Title('Dashboard')]
    public function render()
    {
        // dd(auth()->user()->role);
        return view('livewire.backend.school.dashboard');
    }
}
