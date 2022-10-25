<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AssignGuard ;
use Validator;
use App\Helpers\FileHelper;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Expertise;
use App\Models\Service;

use Auth;

class ProductController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:provider_api')->only('store');
    	//$this->middleware('assign.guard');
        // $this->middleware('auth:users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$products = Product::all();

    	return response()->json([
    		"status" => true,
    		"message" => "product List",
    		"data" => $products
    	]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$validator = Validator::make($request->all(), [
    		'name_ar' => 'required|string',
    		'name_en' => 'required|string',
    		'expertise_id' => 'exists:expertises,id',
            'service_id' => 'exists:services,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'status' => 'in:جديد,مستعمل',
            'delivery_date' => 'date',
            'publish_date' => 'date',
            'description' => 'string' ,
            'price' => 'integer|min:0',
            'old_price' => 'integer|min:0',
            'year' => 'digits:4' ,
        ]);

    	if ($validator->fails()) {
    		return response()->json([
    			'status' => false,
    			'message' => 'Invalid Inputs',
    			'error' => $validator->errors()
    		]);
    	}


    	$product = new Product();
        $provider_id = Auth::guard('provider_api')->user()->id;
        $product->provider_name = Provider::find(Auth::guard('provider_api')->user()->id)->name;
        $product->name_ar = $request->name_ar;
        $product->name_en = $request->name_en;
        $product->pages_number = $request->pages_number;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->status = $request->status;
        $product->delivery_date = $request->delivery_date;
        $product->publish_date = $request->publish_date;
        $product->status = $request->status;
        $product->university = $request->university;
         $product->year = $request->year;
         if ($product->image) {
            $product->image = FileHelper::upload_file('admins', $request->image);
         }
        
        
        $product->service_id =$request->service_id;
        $product->expertise_id =$request->expertise_id;
        $product->expertise_name = Expertise::find($request->expertise_id)->name;
        $product->service_name = Service::find($request->service_id)->name;
        $product->expertise()->associate($request->expertise_id);
        $product->provider()->associate($provider_id);
        $product->service()->associate($request->service_id);
        $product->save();

        


        return response()->json([
          "status" => true,
          "message" => "Product created successfully.",
          "data" => $product
      ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    	if (is_null($product)) {
    		return response()->json([
    			'status' => false,
    			'message' => 'Product not found'
    		]);
    	}

    	return response()->json([
    		"success" => true,
    		"message" => "Product found.",
    		"data" => $product
    	]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

    	$validator = Validator::make($request->all(), [
    		'name_ar' => 'required|string',
    		'name_en' => 'required|string',
    		'expertise_id' => 'sometimes|exists:expertises,id',
    		'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
         'status' => 'in:new,utilizes',
         'delivery_date' => 'required|date',
         'description' => 'string' ,
         'price' => 'required|integer|min:0',
     ]);

    	if($validator->fails()){
    		return response()->json([
    			'status' => false,
    			'message' => 'Invalid Inputs',
    			'error' => $validator->errors()
    		]);      
    	}

    	
    	$product->name_ar = $request->name_ar;
    	$product->name_en = $request->name_en;
    	$product->pages_number = $request->pages_number;
    	$product->description = $request->description;
    	$product->price = $request->price;
        $product->university = $request->university;
        $product->status = $request->status;
        $product->delivery_date = $request->delivery_date;
        $product->status = $request->status;
        $product->image = FileHelper::upload_file('admins', $request->image);
        $product->expertise_id= $request->expertiseId;


        $product->save();

        return response()->json([
          "status" => true,
          "message" => "Product updated successfully.",
          "data" => $product
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
    	$product->delete();
    	return response()->json([
    		"status" => true,
    		"message" => "Product deleted successfully.",
    		"data" => $product
    	]);
    }
}
