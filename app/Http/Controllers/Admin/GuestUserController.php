<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\GuestUserRequest;
use App\Models\User;
use Session;

class GuestUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type','guest-writer')->orderBy('id','desc')->get();
        return view('admin.guest_users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heading_title = "Add Guest";
        $user = NULL;
        return view('admin.guest_users.add_edit',compact('heading_title','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\Admin/GuestUSer  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuestUserRequest $request)
    {
        $data = $request->all();
        $user = new User;
        $user->fill($data);
        $user->password = \Hash::make($request->password);
        $user->type = 'guest-writer';
        $user->save();
        Session::flash('success','Guest User created successfully');
        return redirect()->route('admin.guest_user.index');
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
        $data['user'] = User::find($id);
        $data['heading_title'] = "Edit Guest";
        return view('admin.guest_users.add_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\Admin/GuestUSer  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuestUserRequest $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $user->fill($data);
        $user->type = 'guest-writer';
        $user->password = $request->password ? \Hash::make($request->password) : $user->password;
        $user->save();
        Session::flash('success','Guest User updated successfully');
        return redirect()->route('admin.guest_user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->delete()){
            Session::flash('success','Guest User deleted successfully');
            return redirect()->route('admin.user.index');
        }
    }
}
