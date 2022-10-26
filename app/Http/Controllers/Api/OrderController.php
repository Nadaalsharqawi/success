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

        //$this->middleware('assign.guard');
   $this->middleware('auth:provider_api' , ['except' => ['addOrder']]);
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

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function showOrder($id)
     {
        $order = Order::find($id);
        if($order)
        {
            $product =Product::find($order->product_order_id) ;
            $user = User::find($order->user_order_id);
            return response()->json([
                "status" => true,
                "message" => " Show Order",
                "data" => $order ,
                "product" => $product ,
                "user" => $user 
            ]);
        }
    }



    public function addOrder($id)
    {

    	$order = new Order();
        $user_order_id = Auth::guard('user_api')->user()->id;
        $product = Product::find($id);
        if($product){

            $order->product()->associate($id);
            $order->user()->associate($user_order_id);
            $order->save();


            return response()->json([
              "status" => true,
              "message" => "Order created successfully.",
              "data" => $order
          ]);
        }
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
        $order->save();
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
     public function reject($id)
     {
       $order = Order::find($id);
       if( $order) {
        $order->status_order = 'rejected' ;

        return response()->json([
            "status" => true,
            "message" => "Order has been rejected",
            "data"=>  $order ,

        ]);
    }


}



  /**
     *  reject the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function rejectReason(Request $request , $id)
  {
   $order = Order::find($id);
   if( $order) {

    $validator = Validator::make(
        $request->all(),
        [  
          'reason' => 'string|max:255',
          'description' => 'string|max:255',

      ]
  );
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Invalid Inputs',
            'error' => $validator->errors()
        ], 400);
    }

    $reason = $request->reason;
    $description = $request->description;

    return response()->json([
        "status" => true,
        "message" => "The reasons of order reject",
        "reason"=>  $reason ,
        "description"=> $description

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
