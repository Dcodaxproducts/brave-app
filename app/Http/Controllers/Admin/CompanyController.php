<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CompanyRequest;
use App\Models\{
    User,
    Company
};

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['companies'] = Company::orderBy('id','desc')->get();
        return view('admin.companies.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading_title'] = "Add Company";
        $data['user'] = NULL;
        return view('admin.companies.add_edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        $user = User::createCompanyUser($data);
        $company = new Company;
        $company->user_id = $user['user_id'] ?? "";
        $company->name = $data['name'] ?? "";
        $company->slug = $data['slug'] ?? "";
        $company->description = $data['about'] ?? "";
        $company->is_active = $data['status'] ?? 1;
        $company->image = $user['image'] ?? "";
        $company->save();
        return redirect()->route('admin.companies.index')->with('success','Company created successfully');
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
        $data['company'] = Company::with('user')->find($id);
        $data['heading_title'] = "Edit Company";
        return view('admin.companies.add_edit',$data);
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
        $company = Company::with('user')->find($id);
        if(isset($company['user']->id)){
            $data['user_id'] = $company['user']->id;
            $data['user_pwd'] = $company['user']->password;
            $user = User::updateCompanyUser($data);
        }
        $company->name = $data['name'] ?? "";
        $company->slug = $data['slug'] ?? "";
        $company->description = $data['about'] ?? "";
        $company->is_active = $data['status'] ?? 1;
        $company->image = $user['image'] ?? "";
        $company->save();
        return redirect()->route('admin.companies.index')->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
