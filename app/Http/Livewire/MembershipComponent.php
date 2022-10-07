<?php

namespace App\Http\Livewire;

use App\Models\Membership;
use Livewire\Component;

class MembershipComponent extends Component
{
    public function render()
    {
        $memberships = Membership::orderBy('id', 'desc')->get();
        return view('livewire.membership-component',compact('memberships'));
    }

    public function off($membership_id)
    {
        $membership = Membership::findOrFail($membership_id);
        if ($membership->off == 0) {
            $membership->off = 1;
            $membership->save();
            session()->flash('message', 'Membership has been suspended');
        } else {
            $membership->off = 0;
            $membership->save();
            session()->flash('message', 'Membership activated');
        }
    }
}
