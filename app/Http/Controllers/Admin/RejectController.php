<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reject;


class RejectController extends Controller
{
    //
     public function index()
    {
       
        $reject = Reject::all();
        // dd($order);
        return view('admin.rejects.index', compact('reject'));
    }

      public function destroy($id)
      {
        //
        $reject=Reject::find($id);
        $reject->delete();

        session()->flash('success', trans('admin.delete-message'));
        return redirect()->route('rejects.index');

    }
}
