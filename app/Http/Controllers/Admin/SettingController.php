<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Country;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Service;
    public function __construct(SettingService $adsSer)
    {
        $this->Service = $adsSer;
    }

    public function index()
    {
        $settings = $this->Service->index();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all()->pluck('name', 'id');
        return view('admin.settings.insert', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $setting = $this->Service->store($request);
        $countries = Country::whereIn('id', $request->country_id)->get();
        foreach ($countries as $country) {
            $country->setting_id = $setting->id;
            $country->save();
        }
        session()->flash('success', trans('admin.add-message'));
        return redirect()->route('settings.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->Service->show($id);
        $countries = Country::all()->pluck('name', 'id');
        return view('admin.settings.edit', compact('data', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        $setting = $this->Service->update($id, $request);
        $countries = Country::whereIn('id', $request->country_id)->get();
        $oldCountry = Country::where('setting_id', $id)->get();
        foreach ($oldCountry as $country) {
            $country->setting_id = null;
            $country->save();
        }
        foreach ($countries as $country) {
            $country->setting_id = $setting->id;
            $country->save();
        }
        session()->flash('success', trans('admin.edit-message'));
        return redirect()->route('settings.index');
    }

    public function getPrivacy()
    {
        $data = $this->SettingService->getSettingData('policy', app()->getLocale());
        return view('admin.settings.privacy', compact('data'));
    }

    public function getTerms()
    {
        $data = $this->SettingService->getSettingData('terms', app()->getLocale());
        return view('admin.settings.terms', compact('data'));
    }

    public function changeLang($lang)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->lang = $lang;
        $user->save();
        return redirect()->back();
    }
}
