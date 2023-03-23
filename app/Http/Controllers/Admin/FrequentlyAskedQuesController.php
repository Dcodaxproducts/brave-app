<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use Session;

class FrequentlyAskedQuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['faqs'] = Faq::orderBy('id','desc')->get();
        return view('admin.faqs.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\RequestsAdmin\SettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $faq = new Faq;
        $faq->fill($data);
        $faq->save();
        Session::flash('success','faq added successfully');
        return redirect()->route('admin.faqs.index');
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
        
        $data['faqs'] = Faq::where('id', $id)->get();
        return view('admin.faqs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\RequestsAdmin\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $faq = Faq::find($request->id);
        $faq->fill($data);
        $faq->save();
        Session::flash('success','faq updated successfully');
        return redirect()->route('admin.faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        if($faq->delete()){
            Session::flash('success','faq deleted successfully');
            return redirect()->route('admin.faqs.index');
        }
    }
}
