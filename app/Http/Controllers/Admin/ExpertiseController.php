<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Expertise;
use App\Http\Requests\StoreExpertiseRequest;
use App\Http\Requests\UpdateExpertiseRequest;


class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $expertise = Expertise::all();
        return view('admin.expertise.index', compact('expertise'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          
          
          return view('admin.expertise.insert');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpertiseRequest $request)
    {
        Expertise::create($request->all());
        
        session()->flash('success', trans('admin.add-message'));
        return redirect()->route('expertises.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
         $data =Expertise::show($Expertise->id);
        return view('admin.cities.show', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expertise=Expertise::findOrFail($id);
        // $expertise = Expertise::show($id);
        return view('admin.expertise.edit',compact('expertise'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpertiseRequest $request, $id)
    {
        //
        $expertise=Expertise::findOrFail($id);
        $expertise->update($request->all());

         session()->flash('success', trans('admin.add-message'));
          return redirect()->route('expertises.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $expertise=Expertise::find($id);
        $expertise->delete();

        session()->flash('success', trans('admin.delete-message'));
        return redirect()->route('expertises.index');

    }
}
