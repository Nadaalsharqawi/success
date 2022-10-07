<?php

namespace App\Http\Controllers\Admin;

use App\Models\College;
use App\Models\University;
use App\Services\CollegeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CollegeRequest;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Service;
    public function __construct(CollegeService $CollegeSer)
    {
        $this->Service = $CollegeSer;
    }

    public function index()
    {
        $colleges = $this->Service->index();
        return view('admin.colleges.index' , compact( 'colleges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $universities = University::all()->pluck('name', 'id');
        return view('admin.colleges.insert',compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollegeRequest $request)
    {
        $this->Service->store($request);
        session()->flash('success' , trans('admin.add-message'));
        return redirect()->route('colleges.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(College $country)
    {
        $data = $this->Service->show($country->id);
        return view('admin.colleges.show' , compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(College $college)
    {
        $data = $this->Service->show($college->id);
        $universities = University::all()->pluck('name', 'id');
        return view('admin.colleges.edit' , compact('data','universities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CollegeRequest $request, $id)
    {
        $this->Service->update($id , $request);
        session()->flash('success' , trans('admin.edit-message'));
        return redirect()->route('colleges.index');
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
        return redirect()->route('colleges.index');
    }
}
