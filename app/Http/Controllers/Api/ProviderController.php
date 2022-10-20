<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
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
        return response()->json([
             'status' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('provider_api')->factory()->getTTL() * 60
        ]);
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
            'type' => 'in:provider, user',
            'countryId' => 'exists:countries,id',
            'serviceId' => 'exists:services,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = Provider::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => 'Provider successfully registered',
            'user' => $user
        ], 201);
    }

}
