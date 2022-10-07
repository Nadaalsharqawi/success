<?php

namespace App\Http\Controllers\Admin;

use App\Services\MembershipService;
use App\Http\Controllers\Controller;
use App\Http\Requests\MembershipRequest;
use App\Models\Country;
use App\Models\Service;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Service;
    public function __construct(MembershipService $membershipsSer)
    {
        $this->Service = $membershipsSer;
    }

    public function index()
    {
        return view('admin.memberships.index');
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
        return view('admin.memberships.insert', compact('countries','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MembershipRequest $request)
    {
        $membership = $this->Service->store($request);
        $membership->countries()->attach($request->country_id);
        session()->flash('success' , trans('admin.add-message'));
        return redirect()->route('memberships.index');
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
        return view('admin.memberships.edit' , compact('data','countries','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MembershipRequest $request, $id)
    {
        $Ads = $this->Service->update($id , $request);
        $Ads->countries()->sync($request->country_id, false);
        session()->flash('success' , trans('admin.edit-message'));
        return redirect()->route('memberships.index');
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
        return redirect()->route('memberships.index');
    }

    public function discount(Request $request)
    {
        $request->validate([
            'discount' => 'required|numeric',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|after:start_date',
        ]);
        $this->Service->discount($request);
        session()->flash('success' , trans('admin.Discount_has_been_added'));
        return redirect()->route('memberships.index');
    }
}
