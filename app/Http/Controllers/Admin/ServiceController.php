<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\Service;
use App\Services\ServiceService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Service;
    public function __construct(ServiceService $ServiceSer)
    {
        $this->Service = $ServiceSer;
    }

    public function index()
    {
        $services = $this->Service->index();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all()->pluck('name', 'id');
        return view('admin.services.insert', compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = $this->Service->store($request);
        $service->countries()->attach($request->country_id);
        session()->flash('success', trans('admin.add-message'));
        return redirect()->route('services.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $data = $this->Service->show($service->id);
        $country = Country::all()->pluck('name', 'id');
        return view('admin.services.edit', compact('data', 'country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $serv = $this->Service->update($service->id, $request);
        if ($request->country_id[0] != null) {
            $serv->countries()->sync($request->country_id, false);
        }
        session()->flash('success', trans('admin.edit-message'));
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $this->Service->destroy($service->id);
        session()->flash('success', trans('admin.delete-message'));
        return redirect()->route('services.index');
    }
}
