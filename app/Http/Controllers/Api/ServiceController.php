<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AssignGuard ;
use Validator;
use App\Helpers\FileHelper;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {

        $this->middleware('assign.guard');
        // $this->middleware('auth:users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servises = Service::all();
        
        return response()->json([
            "status" => true,
            "message" => "Service List",
            "data" => $servises
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
            'name' => 'required',
            'countryId' => 'exists:countries,id',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ]);
        }
          
         $service = new Service();
         $service->name = $request->name;
         $service->logo = FileHelper::upload_file('admins', $request->logo);
         $service->countries()->attach($request->countryId);
         $service->save();

          if(auth()->guard('provider_api')){
            $provider =auth()->guard('provider_api'); 
             $provider->user()->services()->attach($service->id);
        }
        
        return response()->json([
            "status" => true,
            "message" => "Service created successfully.",
            "data" => $service
        ]);
          
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        if (is_null($service)) {
            return response()->json([
                'status' => false,
                'message' => 'Service not found'
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Service found.",
            "data" => $service
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'countryId' => 'exists:countries,id',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ]);      
        }
       
        $service->name = $request->get('name');
        $service->logo = FileHelper::upload_file('admins', $request->logo);
        $service->countries()->sync($request->countryId, false);
        
       
        $service->save();
        
        return response()->json([
            "status" => true,
            "message" => "Service updated successfully.",
            "data" => $service
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json([
            "status" => true,
            "message" => "Service deleted successfully.",
            "data" => $service
        ]);
    }
}
