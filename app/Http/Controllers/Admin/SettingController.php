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
        $settings = Setting::orderBy('id','desc')->get();
        return view('admin.settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading_title'] = "Add";
        return view('admin.settings.add_edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\RequestsAdmin\SettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $setting = new Setting;
        $setting->fill($data);
        $setting->save();
        Session::flash('success','Setting added successfully');
        return redirect()->route('admin.setting.index');
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
        $data['setting'] = Setting::find($id);
        $data['heading_title'] = "Edit";
        return view('admin.settings.add_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\RequestsAdmin\SettingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $setting = Setting::find($id);
        $setting->fill($data);
        $setting->save();
        Session::flash('success','Setting updated successfully');
        return redirect()->route('admin.setting.index');
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
            return redirect()->route('admin.setting.index');
        }
    }
}
