<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Service;
use App\Models\Ads;
use App\Models\Order;
use Validator;


class ProviderController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        $providers = Provider::all();
        
        return response()->json([
            "status" => true,
            "message" => "Provider List",
            "data" => $providers
        ]);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showProvider($id)
     {   
       $provider = Provider::find($id);

       if (is_null($provider)) {
        return response()->json([
            'status' => false,
            'message' => 'Provider not found'
        ]);
    }
    $ads=Ads::where('type','ad')->where('provider_id',$id)->get();

    $offers=Ads::where('type','offer')->where('provider_id', $id)->get();
    $services= $provider->services()->get();
    
    return response()->json([
        "success" => true,
        "message" => "Provider found.",
        "provider" => $provider ,
        "services" => $services ,
        "offers" => $offers ,
        "ads" => $ads ,
    ]);
}

public function login()
{
    $credentials = request(['phone', 'password']);
    if (!$token = auth()->guard('provider_api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
}

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('provider_api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('provider_api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('provider_api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = auth('provider_api')->user();
        $minutes = auth('provider_api')->factory()->getTTL() * 60;
        $timestamp = now()->addMinute($minutes);
        $expires_at = date('M d, Y H:i A', strtotime($timestamp));
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'user' => $user ,
            'type' => 'provider',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_at' => $expires_at
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:providers',
            'phone' => 'required|string|min:8|unique:providers',
            'password' => 'required|string|confirmed|min:8',
            'whatsapp' => 'required|string|min:8|unique:providers',
            'address' => 'string',
            'facebook' =>  'string',
            'instagram' => 'string',
            'snap_chat' => 'string',
            'type' => 'in:شخص,جهة',
            'countryId' => 'exists:countries,id',
            'serviceId' => 'exists:services,id',
            'image' => 'nullable',

        ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors()->toJson(), 400);
        // }

        
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ], 400);
        }


        $user = Provider::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'status' => true,
            'message' => 'Provider successfully registered',
            'user' => $user
        ], 201);
    }



 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 public function providerServices($id)
 {
    $provider = Provider::find($id);
    if($provider) {

     $services= $provider->services()->get();

     return response()->json([
        "status" => true,
        "message" => "Provider List",
        "data" => $services
    ]);
 }
 
}



}
