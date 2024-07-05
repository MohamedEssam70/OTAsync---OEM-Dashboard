<?php

namespace App\Livewire;

use App\Models\Session;
use Livewire\Component;

class SessionComponent extends Component
{
    public Session $session;
    public $activeFrame = 0;
    public function render()
    {
        return view('livewire.session-component');
    }
}
