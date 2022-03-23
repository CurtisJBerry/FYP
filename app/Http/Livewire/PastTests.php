<?php

namespace App\Http\Livewire;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PastTests extends Component
{
    public function render()
    {
        return view('livewire.past-tests', [
            'user' => $this->read(), ]);
    }

    public function read()
    {

        return User::where('id','=', Auth::user()->id)->paginate(5);
    }
}
