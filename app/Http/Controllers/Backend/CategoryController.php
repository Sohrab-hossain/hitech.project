<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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
            'image'  => 'nullable|image',
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
            $image = $request->file('image');
            $img = time() . '.'. $image->getClientOriginalExtension();
            $location = 'assets/backend/uploads/categories/';
            //$location = 'public/backend/uploads/categories/' .$img;
            //Image::make($image)->save($location);
            //dd($location);
            $image->move($location, $img);
            $category->image = $img;
        }


        $category->save();

        // redirect
        session()->flash('message','Member Saved Successfully!');
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
        //
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
        //
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
    }


}
