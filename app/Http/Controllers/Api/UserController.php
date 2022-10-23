<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AssignGuard ;
use Validator;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
   public function __construct() {

        $this->middleware('assign.guard');
        $this->middleware('auth:user_api');
    }
   
     public function showProviders()
    {
        // dd(auth()->guard('user_api')->user()->id);
        $country=Provider::where('country_id', auth()->guard('user_api')->user()->country_id)
          ->inRandomOrder()->get(['name','image']);

        return response()->json([
            "status" => true,
            "message" => "success",
            "data" => $country
        ]);
    }
}