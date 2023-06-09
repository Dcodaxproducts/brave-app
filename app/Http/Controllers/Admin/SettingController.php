<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Session;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['settings'] = Setting::orderBy('id','desc')->get();
        return view('admin.settings.index',$data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.add');
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
        $setting = new Setting;
        $setting->fill($data);
        $setting->save();
        Session::flash('success','Setting added successfully');
        return redirect()->route('admin.settings.index');
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
        
        $data['settings'] = Setting::where('id', $id)->get();
        return view('admin.settings.edit', $data);
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
        $setting = Setting::find($request->id);
        $setting->fill($data);
        $setting->save();
        Session::flash('success','Setting updated successfully');
        return redirect()->route('admin.settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Setting::find($id);
        if($setting->delete()){
            Session::flash('success','Setting deleted successfully');
            return redirect()->route('admin.settings.index');
        }
    }
}
