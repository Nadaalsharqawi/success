<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\PriceOffer;
use App\Models\Reject;
use App\Models\Provider;
use Validator;
use Auth ;

class PriceOfferController extends Controller
{

 /**
     * Create a new AuthController instance.
     *
     * @return void
     */
 public function __construct() {

       // $this->middleware('assign.guard');
 	$this->middleware('auth:user_api' , ['except' => ['addPriceOffer']]);
 }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$offers = PriceOffer::all();

    	return response()->json([
    		"status" => true,
    		"message" => "Offer List",
    		"data" => $offers
    	]);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showOffer($id)
    {
    	$offer = PriceOffer::find($id);
    	if($offer)
    	{
    	$product =$offer->product ;
        $provider = $offer->provider;
    	return response()->json([
    		"status" => true,
    		"message" => "Show Offer",
    		"data" => $offer ,
    		"product" => $product ,
    		"provider" => $provider 
    	]);
    }
    }

    public function addPriceOffer(Request $request ,$id)
    {

    	$price_offer = new PriceOffer();
    	$provide_offer_id = Auth::guard('provider_api')->user()->id;
    	$product = Product::find($id);
    	if($product){
    	$provider = Provider::find($provide_offer_id);
    	$price_offer->price_offer = $request->price_offer ;     
    	$price_offer->provider()->associate($provide_offer_id);
    	$price_offer->product()->associate($id);
    	$price_offer->save();




    	return response()->json([
    		"status" => true,
    		"message" => "PriceOffer has been added successfully.",
    		"data" => $price_offer
    	]);
    }
}


     /**
     *  delivery the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function accept($id)
     {
     	$offer = PriceOffer::find($id);

     	if( $offer) {
     		$offer->status_offer = 'accept' ;
     		$offer->save();

     		return response()->json([
     			"status" => true,
     			"message" => "Offer has been delivered successfully.",
     			"data" => $offer
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
     	$offer = PriceOffer::find($id);
     	
     		$offer->status_offer = 'rejected' ;
            $offer->save();

     		return response()->json([
     			"status" => true,
     			"message" => "Offer has been rejected",
     			"data" => $offer
     		]);
     	}
     

  /**
     *  reject the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function rejectReason(Request $request , $id)
     {
     	$offer = PriceOffer::find($id);

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
     			"message" => " The reasons of offer reject  ",
     			"reason"=>  $reason ,
     			"description"=> $description

     		]);
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
