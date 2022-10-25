<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Reject;
use Validator;
use Auth ;
class OrderController extends Controller
{


 /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('assign.guard');
         $this->middleware('auth:provider_api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        
        return response()->json([
            "status" => true,
            "message" => "Order List",
            "data" => $orders
        ]);
    }



    public function addOrder($id)
    {

    	$order = new Order();
        $user_id = Auth::guard('user_api')->user()->id;
        $product = Product::find($id);
        $user = User::find($user_id);
        $order->provider_name = $product->provider_name;
        $order->provider_id = $product->provider_id;
        $order->name_ar = $product->name_ar;
        $order->name_en = $product->name_en;
        $order->pages_number = $product->pages_number;
        $order->description = $product->description;
        $order->price = $product->price;
        $order->old_price = $product->old_price;
        $order->status_order = $product->status;
        $order->delivery_date = $product->delivery_date;
        $order->publish_date = $product->publish_date;
        $order->status = $product->status;
        $order->university = $product->university;
        $order->year = $product->year;
        $order->image = $product->image;
        
        $order->service_name =$product->service_name;
        $order->expertise_name =$product->expertise_name;
        $order->user()->associate($user_id);
        $order->user_name = $user->name ;
        $order->user_phone = $user->user_phone ;
        $order->save();

        


        return response()->json([
          "status" => true,
          "message" => "Order created successfully.",
          "data" => $order
      ]);
    }


     /**
     *  delivery the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function delivery($id)
    {
      $order = Order::find($id);

       if( $order) {
        $order->status_order = 'delivery' ;
       return response()->json([
          "status" => true,
          "message" => "Order has been delivered successfully.",
          "data" => $order
      ]);
    }
}

     /**
     *  reject the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request , $id)
    {
         $order = Order::find($id);
          if( $order) {
        $order->status_order = 'rejected' ;

        $validator = Validator::make(
            $request->all(),
            [       'reason' => 'required',
                    'description' => 'required|string|max:255',
                    'order_id' => 'exists:orders,id',
                    'provider_id' => 'exists:providers,id',
            ]
        );
 
            
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Inputs',
                    'error' => $validator->errors()
                ], 400);
            }

            $reject = new Reject();
            $reject->reason = $request->reason;
            $reject->description = $request->description;
            $reject->order_id = $id;
            $reject->provider_id = auth()->guard('provider_api')->user()->id;
    
            $reject->save();

 
     
         

        return response()->json([
          "status" => true,
          "message" => "Order has been rejected",
          "data" => [
            "orders"=>  $order ,
            "reject"=> $reject
            ]
      ]);
    }
    }

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function providerOrders()
     {
        $orders = Order::where('provider_id', auth()->guard('provider_api')->user()->id)->get();
        
        return response()->json([
            "status" => true,
            "message" => " Order List for provider",
            "data" => $orders
        ]);
    }

}
