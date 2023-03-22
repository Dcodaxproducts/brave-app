<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Models\Category;
use Session;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = Category::with('category')->whereHas('category',function($query){
            $query->where('deleted_at',null);
            $query->where('is_active',1);
        })->where('parent_id','!=',0)->orderBy('id','desc')->get();
        return view('admin.sub_categories.index',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::where('parent_id',0)->orderBy('id','desc')->get();
        $data['heading_title'] = "Add";
        return view('admin.sub_categories.add_edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        $data = $request->all();
        $sub_cat = new Category;
        $data['user_id'] = auth()->user()->id;
        $sub_cat->fill($data);
        $sub_cat->save();
        Session::flash('success','Subcategory added successfully');
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
        $data['categories'] = Category::where('parent_id',0)->orderBy('id','desc')->get();
        $data['sub_category'] = Category::find($id);
        $data['heading_title'] = "Edit";
        return view('admin.sub_categories.add_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $sub_category = Category::find($id);
        $sub_category->fill($data);
        $sub_category->save();
        Session::flash('success','Sub category updated successfully');
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
        $sub_category = Category::find($id);
        if($sub_category->delete()){
            Session::flash('success','Sub category deleted successfully');
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
        $sub_category = Category::find($request->id);
        if($sub_category->is_active==1)
        {
            $sub_category->is_active = 0;
            $sub_category->save();
            return response()->json(['status'=>1]);
        }

        if($sub_category->is_active==0)
        {
            $sub_category->is_active = 1;
            $sub_category->save();
            return response()->json(['status'=>1]);
        }
    }
}
