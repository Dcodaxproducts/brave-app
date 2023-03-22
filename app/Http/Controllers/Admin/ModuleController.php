<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ModuleRequest;
use App\Models\{
    Module,
    User
};

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['modules'] = Module::orderBy('id','desc')->get(['id','title','slug','description']);
        return view('admin.modules.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading_title'] = 'Add';
        return view('admin.modules.add_edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {
        $module = new Module;
        $module->create($request->all());
        return redirect()->route('admin.modules.index')->with('success','Successfully added');
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
        $data['module'] = Module::find($id);
        $data['heading_title'] = 'Edit';
        return view('admin.modules.add_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleRequest $request, $id)
    {
        $data['module'] = Module::find($id)->update($request->all());
        return redirect()->route('admin.modules.index')->with('success','Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $module = Module::find($id);
        $module->delete();
        return redirect()->route('admin.modules.index')->with('success','Successfully deleted');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $user = \App\Models\User::first();
        // dd($user->modulesUser);
        $data['users'] = User::with('modules','modulesUser')->orderBy('id','desc')->get(['id','first_name','last_name']);
        return view('admin.modules.user_modules',$data);
    }

    /**
     * Show edit permission page
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function usersEdit($id)
    {
        $data['heading_title'] = "Edit Module Permission";
        $data['user'] = User::with('modules')->find($id);
        $data['modules'] = Module::orderBy('id','desc')->get(['id','title','slug','description']);
        return view('admin.modules.user_module_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usersUpdate(Request $request,$id)
    {
        $data = $request->all();
        $user = User::find($id);
        $user->deletePermissions(); // delete previous permissions
        $user->savePermissions($data['modules']); //Save user permissions
        return redirect()->route('admin.modules.users')->with('success','Successfully updated');
    }
}
