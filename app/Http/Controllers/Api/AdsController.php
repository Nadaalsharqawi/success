<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AssignGuard ;
use App\Helpers\FileHelper;
use Validator;
use App\Models\Ads;
use App\Models\Provider;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    public function __construct() {

        $this->middleware('auth:provider_api' , ['except' => ['createAds']]);
       // $this->middleware('auth:provider_api');
    }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function adsAndOffers()
     {
        $adds = Ads::where('provider_id', auth()->guard('provider_api')->user()->id)->get();
        
        return response()->json([
            "status" => true,
            "message" => "Ads And Offers List for provider",
            "data" => $adds
        ]);
    }
   
     public function showAds()
    {
        // dd(auth()->guard('provider_api')->user()->id);
        
        // $ad=Ads::get();
        // foreach ($ad as $ada) {}
        // if ($ad[0]->type== 'ad') {}

        $ads=Ads::where('type','ad')->where('provider_id', auth()->guard('provider_api')->user()->id)->get();

            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $ads
            ]);
        
     }

        public function showOffer()
         {
        // dd(auth()->guard('provider_api')->user()->id);
        
        // $ad=Ads::get();
        // foreach ($ad as $ada) {}
        // if ($ad[0]->type== 'ad') {}

        $ads=Ads::where('type','offer')->where('provider_id', auth()->guard('provider_api')->user()->id)->get();

            return response()->json([
                "status" => true,
                "message" => "success",
                "data" => $ads
            ]);
        
    }

     public function createAds(Request $request)
         {
            $validator = Validator::make($request->all(), [
            'body' => 'required|string|max:255',
            'image' => 'required|image',
            'date_publication' => 'required|integer|between:1,30',
            'provider_id' => 'exists:providers,id',
            'type' => 'required|in:ad,offer']   ,

            ['type.in' => 'You must choose from ad or offer!']
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ], 401);
        }


                   

        $ad = new Ads();
        $ad->body = $request->body;
        $ad->date_publication = $request->date_publication;
        $ad->type = $request->type;
        $ad->provider_id = auth()->guard('provider_api')->user()->id;
        $ad->image = FileHelper::upload_file('ads', $request->image);

        $ad->save();

        
         return response()->json([
            'status' => true,
            'message' => 'Ad successfully registered',
            'data' => $ad
        ], 200);



         }

}
