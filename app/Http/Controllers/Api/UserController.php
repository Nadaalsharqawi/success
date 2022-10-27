<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AssignGuard ;
use App\Models\User;
use Validator;
use App\Models\Provider;
use App\Models\Membership;
use App\Models\Product;
use App\Models\Ads;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
   public function __construct() {

      //  $this->middleware('assign.guard');
        $this->middleware('auth:user_api' , ['except' => ['addOrder' ,'']]);
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



    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            "status" => true,
            "message" => "User deleted successfully.",
            "data" => $user
        ]);
    } 

     public function showHome(){
           
        $service=Service::all();
        $ads=Ads::where('type', 'ad')->get();
        $offers=Ads::where('type', 'offer')->get();
        $country=Provider::where('country_id', auth()->guard('user_api')->user()->country_id)
          ->inRandomOrder()->get(['name','image']);

        return response()->json([
            "status" => true,
            "message" => "success",
            "data" => [
                    "services" => $service,
                    "ads" =>$ads,
                    "providers"=> $country, 
                    "offers"=> $offers ]
                ]);


     }
      public function searchProduct(Request $request)
        {
            
            $product=Product::where('service_name', 'like' ,"%{$request->service}%")->get();

            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $product 
                ]);

            }

              public function showCurrentMembership()
        {
            $user=User::find(auth()->guard('user_api')->user()->id);
            $membership=$user->membership;


              // $product=User::where('id',auth()->guard('user_api')->user()->id)
              // ->select('membership_id')->get();


            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $membership 
                ]);

            }
            
     
}

