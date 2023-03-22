<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('parent_id',0)->orderBy('id','desc')->get();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heading_title = "Add";
        return view('admin.categories.add_edit',compact('heading_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        $data['parent_id'] = 0;
        $data['user_id'] = auth()->user()->id;
        $category = new Category;
        $category->fill($data);
        $category->save();
        Session::flash('success', 'Category addedd successfully');
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
        $category = Category::find($id);
        $heading_title = "Edit";
        return view('admin.categories.add_edit',compact('category','heading_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $data = $request->all();
        $category = Category::find($id);
        $data['parent_id'] = 0;
        $data['user_id'] = auth()->user()->id;
        $category->fill($data);
        $category->save();
        Session::flash('success','Category updated successfully');
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
        $category = Category::find($id);
        if($category->delete())
        {
            Session::flash('success','Category deleted successfully');
            return redirect()->back();
        }
    }

    /**
     * Update the status of specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request)
    {
        $category = Category::find($request->id);
        if($category->is_active==1)
        {
            $category->is_active = 0;
            $category->save();
            return response()->json(['status'=>1]);
        }

        if($category->is_active==0)
        {
            $category->is_active = 1;
            $category->save();
            return response()->json(['status'=>1]);
        }
    }
}
