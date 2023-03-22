<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MediaGalleryRequest;
use App\Models\MediaGallery;
use Session;

class MediaGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media_galleries = MediaGallery::orderBy('id','desc')->paginate(10);
        return view('admin.media_galleries.index',compact('media_galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heading_title = "Add";
        return view('admin.media_galleries.add_edit',compact('heading_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaGalleryRequest $request)
    {
        $data = $request->all();
        $data['file_name'] = uploadFile($request->file,'mediagallery'); // calling helper function
        $data['user_id'] = auth()->user()->id;
        $media_gallery = new MediaGallery;
        $media_gallery->fill($data);
        $media_gallery->save($data);
        Session::flash('success','Media uploaded successfully');
        return redirect()->route('admin.mediagallery.index');
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
        $media_gallery = MediaGallery::find($id);
        $heading_title = "Edit";
        return view('admin.media_galleries.add_edit',compact('media_gallery','heading_title'));
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
        $media_gallery = MediaGallery::find($id);
        $data = $request->all();
        if($request->has('file') && $request->file != $media_gallery->file_name){
            deleteFile($media_gallery->file_name, 'uploads\mediagallery'); // calling helper function
            $data['file_name'] = uploadFile($request->file,'mediagallery'); // calling helper function
        };
        $data['user_id'] = auth()->user()->id;
        $media_gallery->fill($data);
        $media_gallery->save($data);
        Session::flash('success','Media updated successfully');
        return redirect()->route('admin.mediagallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mediagallery = MediaGallery::find($id);
        if($mediagallery){
            deleteFile($mediagallery->file_name,'uploads\mediagallery');// calling helper function
            $mediagallery->delete();
            Session::flash('success','Media deleted successfully');
            return redirect()->route('admin.mediagallery.index');
        }
        abort(404);
    }
}
