<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Sub_categoryCntrller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories=Sub_category::orderBy('id','desc')->paginate(5);

        return view('backend.pages.sub_category.index',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::select('id','name')->get();
        return view('backend.pages.sub_category.create',compact('categories'));
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
            'category_id'  => 'required',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'name.required'  => 'Please provide a Sub category name',
                'name.min'  => 'Your Brand Name must consist of at least 2 characters',
                'name.max'  => 'Your Brand Name must consist under 70 characters',
                'category_id.required'  => 'Please select a category name',
                'image.image'  => 'Please provide a valid image with .jpg, .png, .gif, .jpeg exrension..',
            ]);




        // database create / save
        $sub_category = new Sub_category();
        $sub_category->name = $request->name;
        $sub_category->category_id = $request->category_id;
        $sub_category->description = $request->description;

        //insert images also

        if ($request->image > 0) {

            $sub_category->image = $request->image->store('uploads/sub_categories','public');
        }


        $sub_category->save();

        // redirect
        session()->flash('message','Sub Category Insert Successfully!');
        return redirect()->route('admin.sub_category.index');

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
        $sub_category= Sub_category::find($id);
        $categories=Category::select('id','name')->get();
        return view('backend.pages.sub_category.edit',compact('sub_category','categories'));
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
        //verification
        $this->validate($request, [
            'name'  => 'required|min:2|max:70',
            'category_id'  => 'required',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'name.required'  => 'Please provide a Sub category name',
                'name.min'  => 'Your Brand Name must consist of at least 2 characters',
                'name.max'  => 'Your Brand Name must consist under 70 characters',
                'category_id.required'  => 'Please select a category name',
                'image.image'  => 'Please provide a valid image with .jpg, .png, .gif, .jpeg exrension..',
            ]);




        // database update
        $sub_category= Sub_category::find($id);
        $sub_category->name = $request->name;
        $sub_category->category_id = $request->category_id;
        $sub_category->description = $request->description;

        //insert images also

        if ($request->image > 0) {
            //Delete the old image from folder

            /* if (File::exists($category->image)) {
                 File::delete('public\\'.$category->image);
             }*/

            if ($sub_category->image) {
                Storage::delete('public/'.$sub_category->image);
            }

            $sub_category->image = $request->image->store('uploads/sub_categories','public');
        }


        $sub_category->update();

        // redirect
        session()->flash('message','Sub Category Update Successfully!');
        return redirect()->route('admin.sub_category.index');




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
        $sub_category= Sub_category::find($id);

        if ($sub_category->image) {
            Storage::delete('public/'.$sub_category->image);
        }

        $sub_category->delete();

        // redirect
        session()->flash('message','Sub Category Deleted Successfully!');
        return redirect()->route('admin.sub_category.index');
    }
}
