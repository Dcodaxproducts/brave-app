<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Admin,
    Module,
    UserSurvey,
    Partner,
};
use Session;

class PartnerController extends Controller
{
    public function index(){

        $data['partners'] = Partner::orderBy('id','desc')->get();
        return view('admin.partners.index',$data);

    }

    public function create(){

        return view('admin.partners.add');

    }

    public function store(request $request){

        $data = $request->all();
        $partners = Partner::create($data);

        if($partners){

            Session::flash('success','Partner created successfully');
            return redirect()->route('admin.partners.index');
            
        }else{

            Session::flash('error','Error while saving partner');
            return redirect()->route('admin.partners.index');

        }
        
    }

    public function edit($id){

        $data['partners'] = Partner::where('id', $id)->get();
        return view('admin.partners.edit', $data);

    }

    public function update(request $request){

        $data = $request->all();
        $partner = Partner::find($request->id);
        $partner->fill($data);

        if($partner->save()){

            Session::flash('success','Partner Updated successfully');
            return redirect()->route('admin.partners.index');

        }else{

            Session::flash('error','Failed to update partner');
            return redirect()->route('admin.partners.index');
        }
    }

    public function destroy($id){
        
        $partner = Partner::find($id);
        if($partner->delete()){
            Session::flash('success','partner deleted successfully');
            return redirect()->route('admin.partners.index');
        }

        else{
            Session::flash('error','Failed to delete partner');
            return redirect()->route('admin.partners.index');
        }

    }
}
