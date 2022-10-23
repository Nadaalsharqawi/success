<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\AdsSetting;
use App\Http\Requests\StoreAdsSetting;


class AdsSettingController extends Controller
{
    public function index() 
    {

        // $countries = Country::all();
        $ads_settings = AdsSetting::with('countries')->get();
        // dd($ads_settings);
        return view ('admin.adsSetting.index', compact('ads_settings'));

    }

    public function create() 
    {

       $countries = Country::all()->pluck('name', 'id');
        return view('admin.adsSetting.insert', compact('countries'));

    }

        public function store(StoreAdsSetting $request) 
    {   

        // dd($request->all());
         foreach ($request->country_id as $cou) {    
             AdsSetting::create([
            'country_id' =>  $cou ,
            'duration_status' =>  $request->duration_status,
            'date_publication'=>   $request->date_publication,
            // 'duration'=> $request->duration,
         ]);
 
        }
                    
      

        // return redirect()->back();
        // return redirect()->route('ads-Setting.index');
        session()->flash('success', trans('admin.add-message'));
        return redirect()->route('ads-Setting.index');
 
    }

    public function destroy($id)
    {
    
        $AdsSetting=AdsSetting::find($id);
        $AdsSetting->delete();
        
        session()->flash('success', trans('admin.delete-message'));
        return redirect()->route('ads-Setting.index');

        // return redirect()->back();
    }
}
