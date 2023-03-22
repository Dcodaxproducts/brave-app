<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;
use App\Models\{
    User,
    Admin,
    Module,
    UserSurvey
};

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data['users'] = User::orderBy('id','desc')->get();
        return view('admin.users.index',$data);
    }

    public function survey()
    {
        $data['users'] = UserSurvey::orderBy('id','desc')->get();
        return view('admin.survey.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading_title'] = "Add";
        $data['user'] = NULL;
        return view('admin.users.add_edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\Admin/UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $user = new User;
        $user->fill($data);
        $user->password = \Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.user.index')->with('success','User created successfully');
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
        
        $data['heading_title'] = "Edit";
        return view('admin.users.add_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\Admin/UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        $user = User::find($id);
        $data['password'] = $request->password==null ? $user->password : \Hash::make($request->password) ;
        $user->fill($data);
        $user->save();
        return redirect()->route('admin.user.index')->with('success','User updated successfully');
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
            return redirect()->route('admin.user.index')->with('success','User deleted successfully');
        }
    }

    public function details($id){

        $user = User::where('id',$id)->get();
        return response()->json($user, 200);
        
    }

    public function surveyDetails($id){

        $survey = UserSurvey::where('id',$id)->get();
        return response()->json($survey, 200);
        
    }

    
}
