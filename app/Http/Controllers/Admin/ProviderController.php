<?php

namespace App\Http\Controllers\Admin;

use App\Services\ProviderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderRequest;
use App\Models\Country;
use App\Models\Service;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Service;
    public function __construct(ProviderService $provider)
    {
        $this->Service = $provider;
    }

    public function index()
    {
        $providers = $this->Service->index();
        return view('admin.providers.index' , compact( 'providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all()->pluck('name', 'id');
        $services = Service::all()->pluck('name', 'id');
        return view('admin.providers.insert', compact('countries','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        $provider = $this->Service->store($request);
        $provider->countries()->attach($request->country_id);
        $provider->services()->attach($request->service_id);
        session()->flash('success' , trans('admin.add-message'));
        return redirect()->route('providers.index');
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
        $services = Service::all()->pluck('name', 'id');
        return view('admin.ads.edit' , compact('data','countries','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, $id)
    {
        $provider = $this->Service->update($id , $request);
        $provider->countries()->sync($request->country_id, false);
        $provider->services()->sync($request->service_id, false);
        session()->flash('success' , trans('admin.edit-message'));
        return redirect()->route('providers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->Service->destroy($id);
        session()->flash('success' , trans('admin.delete-message'));
        return redirect()->route('providers.index');
    }
}
