<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use App\Models\{
	Post,
	PostShare
};

class PostShareController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$data['posts'] = Post::orderBy('id','desc')->get();
		return view('admin.user-links.index',$data);
    }

    public function create(Request $request)
    {
    	$post = Post::with('postShare')->find($request->post_id);
    	// dd($post['postShare']->post_id);
        if($post){
            if($post['postShare'] && $post['postShare']->post_id==$post->id){
                return response()->json(['status'=>0,'message'=>'You already created link']);
            }
	    	$shareable_link = substr(base64_encode($post->title),0,15);
	    	$post_share = new PostShare;
	    	$post_share->user_id = Auth::user()->id;
	    	$post_share->post_id = $post->id;
	    	$post_share->shareable_link = $shareable_link;
	    	$post_share->count = 0;
	    	$post_share->save();
            return response()->json(['status'=>1,'message'=>'Successfully created link']);
    	}
    }
}
