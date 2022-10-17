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

class ProductController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

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
    		'expertise_id' => 'sometimes|exists:expertises,id',
    		'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
    		 'status' => 'in:new,utilizes',
    		 'delivery_date' => 'required|date',
    		 'description' => 'string' ,
    		 'price' => 'required|integer|min:0',
    	]);

    	if ($validator->fails()) {
    		return response()->json([
    			'status' => false,
    			'message' => 'Invalid Inputs',
    			'error' => $validator->errors()
    		]);
    	}


    	$product = new Product();
    	$product->name_ar = $request->name_ar;
    	$product->name_en = $request->name_en;
    	$product->pages_number = $request->pages_number;
    	$product->description = $request->description;
    	$product->price = $request->price;
    	$product->status = $request->status;
    	$product->delivery_date = $request->delivery_date;
    	$product->status = $request->status;
    	$product->image = FileHelper::upload_file('admins', $request->image);
    	$product->expertise_id= $request->expertiseId;
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
