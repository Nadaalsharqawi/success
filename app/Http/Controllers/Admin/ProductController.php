<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Expertise;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $Service;
    public function __construct(ProductService $ProductSer)
    {
        $this->Service = $ProductSer;
    }

    public function index()
    {
        $products = $this->Service->index();
        return view('admin.products.index' , compact( 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expertise = Expertise::all()->pluck('name', 'id');
        return view('admin.products.insert',compact('expertise'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->Service->store($request);
        session()->flash('success' , trans('admin.add-message'));
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data = $this->Service->show($product->id);
        return view('admin.products.show' , compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {  
        $expertise = Expertise::all()->pluck('name', 'id');
        $data = $this->Service->show($product->id);
        return view('admin.products.edit' , compact('data','expertise'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $this->Service->update($product->id , $request);
        session()->flash('success' , trans('admin.edit-message'));
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->Service->destroy($product->id);
        session()->flash('success' , trans('admin.delete-message'));
        return redirect()->route('products.index');
    }

}
