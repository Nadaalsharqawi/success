<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    //
       public function index()
    {
       
        $order = Order::all();
        // dd($order);
        return view('admin.orders.index', compact('order'));

    }

    
      public function destroy($id)
      {
        //
        $order=Order::find($id);
        $order->delete();

        session()->flash('success', trans('admin.delete-message'));
        return redirect()->route('orders.index');

    }

}
