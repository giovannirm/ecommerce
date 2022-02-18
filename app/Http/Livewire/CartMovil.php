<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartMovil extends Component
{
    protected $listeners = ['render'];
    
    public function render()
    {
        return view('livewire.cart-movil');
    }
}
