<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PseudonymRequest;
use App\Models\Pseudonym;
use App\Models\User;
Use Session;

class PseudonymController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pseudonyms = Pseudonym::with('user')->orderBy('id','desc')->get();
        return view('admin.pseudonyms.index',compact('pseudonyms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['users'] = User::orderBy('id','desc')->get();
        $data['heading_title'] = "Add";
        return view('admin.pseudonyms.add_edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App/Http/Requests/PseudonymRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PseudonymRequest $request)
    {
        $data = $request->all();
        // dd($data);
        $pseudonym = new Pseudonym;
        if($request->has('media') && $request->media){
            $data['media'] = uploadFile($request->media,'mediagallery'); // calling helper function
        }
        $pseudonym->fill($data);
        $pseudonym->save();
        return redirect()->route('admin.pseudonym.index')->with('success','Pseudonym added successfully');
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
        $data['pseudonym'] = Pseudonym::find($id);
        $data['users'] = User::orderBy('id','desc')->get();
        $data['heading_title'] = "Edit";
        return view('admin.pseudonyms.add_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PseudonymRequest $request, $id)
    {
        $pseudonym = Pseudonym::find($id);
        $data = $request->all();
        if($request->has('media') && $request->media){
            $data['media'] = uploadFile($request->media,'mediagallery'); // calling helper function
        }
        $pseudonym->fill($data);
        $pseudonym->save();
        return redirect()->route('admin.pseudonym.index')->with('success','Pseudonym updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pseudonym = Pseudonym::find($id);
        if($pseudonym->delete()){
            return redirect()->route('admin.pseudonym.index')->with('success','Pseudonym deleted successfully');
        }
    }
}
