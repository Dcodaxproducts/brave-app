<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use Illuminate\Http\Request;
use App\Models\{
    Post,
    Pseudonym,
    Category,
    MediaGallery
};
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::with('pseudonym','categories')
                        ->orderBy('id','desc')
                        ->where('type','image')
                        ->get();
        
        return view('admin.posts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['heading_title'] = "Add";
        $data['pseudonyms'] = Pseudonym::orderBy('id','desc')->get();
        $data['mediagalleries'] = MediaGallery::where('type','image')->orderBy('id','desc')->take(10)->get();
        $data['categories'] = Category::with('activeSubCategory')->where('is_active',1)->where('parent_id',0)->orderBy('id','desc')->get();
        return view('admin.posts.add_edit',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['is_trending'] = $request->is_trending==1 ? 1 : 0;
        $data['is_popular'] = $request->is_popular==1 ? 1 : 0;
        $data['is_approved'] = 1;
        $data['tags'] = json_encode($request->tags);
        $post = new Post;
        if($request->has('media') && $request->media){
            $data['media'] = uploadFile($request->media,'mediagallery'); // calling helper function
        }
        $post->fill($data);
        $post->save();
        $category = $post->saveCategories($post->id, $data['categories']); //Save post categories
        if($category==false){
            $post->delete();
            Session::flash('error','Error while saving categories');
            return redirect()->route('admin.posts.index');
        }

        Session::flash('success','Post created successfully');
        return redirect()->route('admin.post.index');
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
        $data['heading_title'] = "Edit";
        $data['categories'] = Category::where('is_active',1)->where('parent_id',0)->orderBy('id','desc')->get();
        $data['pseudonyms'] = Pseudonym::orderBy('id','desc')->get();
        $data['mediagalleries'] = MediaGallery::where('type','image')->orderBy('id','desc')->take(10)->get();
        $data['post'] = Post::with('categories:id,title','pseudonym')->find($id);
        return view('admin.posts.add_edit',$data);
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
        $data['user_id'] = auth()->user()->id;
        $data['is_trending'] = $request->is_trending==1 ? 1 : 0;
        $data['is_popular'] = $request->is_popular==1 ? 1 : 0;
        $data['is_approved'] = 1;
        $post = Post::find($id);
        $data['tags'] = isset($data['tags']) ? json_encode($data['tags']) : $post->tags;
        if($request->has('media') && $request->media){
            $data['media'] = uploadFile($request->media,'mediagallery'); // calling helper function
        }
        $post->fill($data);
        $post->save();
        if($request->has('categories') && $request->categories){
            $post->deleteCategories($post->id);
            $post->saveCategories($post->id,$data['categories']);
        }
        Session::flash('success','Post Updated Successfully');
        return redirect()->route('admin.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->delete()){
            Session::flash('success','Post deleted successfully');
            return redirect()->route('admin.post.index');
        }

        else{
            Session::flash('error','Failed to delete post');
            return redirect()->route('admin.post.index');
        }
    }
}
