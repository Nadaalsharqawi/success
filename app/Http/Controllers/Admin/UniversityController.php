<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\University;
use App\Services\UniversityService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UniversityRequest;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Service;
    public function __construct(UniversityService $universitySer)
    {
        $this->Service = $universitySer;
    }

    public function index()
    {
        $universities = $this->Service->index();
        return view('admin.university.index' , compact( 'universities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::all()->pluck('name', 'id');
        return view('admin.university.insert',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UniversityRequest $request)
    {
        $this->Service->store($request);
        session()->flash('success' , trans('admin.add-message'));
        return redirect()->route('universities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        $data = $this->Service->show($university->id);
        return view('admin.university.show' , compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(University $university)
    {
        $country = Country::all()->pluck('name', 'id');
        $data = $this->Service->show($university->id);
        return view('admin.university.edit' , compact('data','country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UniversityRequest $request, University $university)
    {
        $this->Service->update($university->id , $request);
        session()->flash('success' , trans('admin.edit-message'));
        return redirect()->route('universities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        $this->Service->destroy($university->id);
        session()->flash('success' , trans('admin.delete-message'));
        return redirect()->route('universities.index');
    }
}
