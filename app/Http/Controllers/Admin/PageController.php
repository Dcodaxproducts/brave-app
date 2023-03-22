<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use Session;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pages'] = Page::orderBy('id','desc')->get();
        return view('admin.pages.index',$data);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data['page'] = "NULL";
        $data['heading_title'] = "Add";
        return view('admin.pages.add_edit',$data);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\PageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $data = $request->all();
        $data['tags'] = json_encode($request->tags);
        $page = new Page;
        $page->fill($data);
        $page->save();
        Session::flash('success','Page added successfully');
        return redirect()->route('admin.page.index');
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
        $data['page'] = Page::find($id);
        $data['heading_title'] = "Edit";
        return view('admin.pages.add_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\PageRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        $data = $request->all();
        $data['tags'] = json_encode($request->tags);
        $page = Page::find($id);
        $page->fill($data);
        $page->save();
        Session::flash('success','Page updated successfullly');
        return redirect()->route('admin.page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        if($page->delete()){
            Session::flash('success','Page deleted successfully');
            return redirect()->route('admin.page.index');
        }
    }
}
