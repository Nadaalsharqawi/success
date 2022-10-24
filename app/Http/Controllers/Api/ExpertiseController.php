<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Expertise;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AssignGuard ;
use Validator;
use Illuminate\Support\Facades\Auth;

class ExpertiseController extends Controller
{
    //
      public function __construct() {

        $this->middleware('assign.guard');
        $this->middleware('auth:provider_api');
    }
   
     public function showExpertises()
    {
       
        $expertise=Expertise::all();

            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $expertise
            ]);
        
     }
}
