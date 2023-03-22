<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\JobRequest;
use App\Models\{
    Company,
    CompanyJob,
    CompanyJobUser
};

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jobs'] = CompanyJob::orderBy('id','desc')->get();
        return view('admin.jobs.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading_title'] = "Add Job";
        $data['job'] = NULL;
        $data['companies'] = Company::where('is_active',"1")->get(['id','name']);
        return view('admin.jobs.add_edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobRequest $request)
    {
        CompanyJob::create($request->all());
        return redirect()->route('admin.jobs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!empty($id)){
            $data['job_applications'] = CompanyJobUser::with('user','company')->where('company_job_id',$id)->get();
            return view('admin.jobs.applications',$data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['job'] = CompanyJob::find($id);
        $data['companies'] = Company::where('is_active',"1")->get(['id','name']);
        $data['heading_title'] = "Edit Job";
        return view('admin.jobs.add_edit',$data);
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
        $data = $request->all();
        $user = CompanyJob::find($id);
        $user->fill($data);
        $user->save();
        return redirect()->route('admin.jobs.index')->with('success','Job updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Job::find($id);
        if($user->delete()){
            return redirect()->route('admin.jobs.index')->with('success','Job deleted successfully');
        }
    }
}
