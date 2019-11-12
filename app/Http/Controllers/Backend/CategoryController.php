<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $categories=Category::select('id','name','description')->get();

        $categories=Category::orderBy('id','desc')->paginate(5);
        return view('backend.pages.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category.create');
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
            'name'  => 'required',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'name.required'  => 'Please provide a category name',
                'image.image'  => 'Please provide a valid image with .jpg, .png, .gif, .jpeg exrension..',
            ]);




        // database create / save
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        //insert images also

        if ($request->image > 0) {
            /*$image = $request->file('image');
            $img = time() . '.'. $image->getClientOriginalExtension();
            $location = 'storage/uploads/categories/';
            //$location = 'storage/uploads/categories/' .$img;
            //Image::make($image)->save($location);
            //dd($location);
            $image->move($location, $img);
            $category->image = $img;*/

            $category->image = $request->image->store('uploads/categories','public');
        }


        $category->save();

        // redirect
        session()->flash('message','Category Insert Successfully!');
        return redirect()->route('admin.category.index');

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
        $category= Category::find($id);
        return view('backend.pages.category.edit',compact('category'));
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
            'name'  => 'required',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
            [
                'name.required'  => 'Please provide a category name',
                'image.image'  => 'Please provide a valid image with .jpg, .png, .gif, .jpeg exrension..',
            ]);




        // database create / save
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;

        //insert images also

        if ($request->image > 0) {
            //Delete the old image from folder

           /* if (File::exists($category->image)) {
                File::delete('public\\'.$category->image);
            }*/

            if ($category->image) {
                Storage::delete('public/'.$category->image);
            }

            $category->image = $request->image->store('uploads/categories','public');
        }


        $category->update();

        // redirect
        session()->flash('message','Category Update Successfully!');
        return redirect()->route('admin.category.index');




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
        $category = Category::find($id);

        if ($category->image) {
            Storage::delete('public/'.$category->image);
        }

        $category->delete();

        // redirect
        session()->flash('message','Category Deleted Successfully!');
        return redirect()->route('admin.category.index');
    }


}
