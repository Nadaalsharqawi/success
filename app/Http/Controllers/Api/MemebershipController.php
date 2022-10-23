<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AssignGuard ;
use App\Helpers\FileHelper;
use Validator;
use App\Models\Membership;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;


class MemebershipController extends Controller
{   
    public function showMembership(){

    $membership=Membership::all();

    
      return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $membership
            ]);

    }
    
     public function providerMembership($id){

        $membership=Membership::findOrFail($id); 
        $provider=auth()->guard('provider_api')->user();
        $provider->membership_id=$id;
        $provider->save();
        
     }
}
