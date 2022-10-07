<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserComponent extends Component
{
    public function render()
    {
        $data = User::where('type','admin')->orderBy('id', 'desc')->get();
        return view('livewire.user-component', compact('data'));
    }

    public function status($user_id)
    {
        $user = User::findOrFail($user_id);
        if ($user->is_active == 1) {
            $user->is_active = 0;
            $user->save();
            session()->flash('message', 'Disabled');
        } else {
            $user->is_active = 1;
            $user->save();
            session()->flash('message', 'Enabled');
        }
    }
}
