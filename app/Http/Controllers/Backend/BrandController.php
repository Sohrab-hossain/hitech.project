<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories=Category::select('id','name','description')->get();

        $brands=Brand::orderBy('id','desc')->paginate(5);
        return view('backend.pages.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        //verification
        $this->validate($request, [
            'name'  => 'required|min:2|max:70',
        ],
            [
                'name.required'  => 'Please provide a Brand name',
                'name.min'  => 'Your Brand Name must consist of at least 2 characters',
                'name.max'  => 'Your Brand Name must consist under 70 characters',
            ]);




        // database create / save
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;


        $brand->save();

        // redirect
        session()->flash('message','Brand Insert Successfully!');
        return redirect()->route('admin.brand.index');

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand= Brand::find($id);
        return view('backend.pages.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //verification
        $this->validate($request, [
            'name'  => 'required|min:2|max:70',
        ],
            [
                'name.required'  => 'Please provide a Brand name',
                'name.min'  => 'Your Brand Name must consist of at least 2 characters',
                'name.max'  => 'Your Brand Name must consist under 70 characters',
            ]);




        // database create / save
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->description = $request->description;

        $brand->update();

        // redirect
        session()->flash('message','Brand Update Successfully!');
        return redirect()->route('admin.brand.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // database Delete
        $brand = Brand::find($id);


        $brand->delete();

        // redirect
        session()->flash('message','Brand Deleted Successfully!');
        return redirect()->route('admin.brand.index');
    }
}
