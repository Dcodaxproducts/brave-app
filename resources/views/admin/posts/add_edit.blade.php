@php
$page_class = 'posts';
@endphp
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <h4 class="card-title">Posts</h4> --}}
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-info pull-right m-b-10" href="{{ route('admin.post.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">{{ $heading_title }} Post</h4>
                                </div>
                                <div class="card-body">
                                    @if(isset($post))
                                    <form action="{{ route('admin.post.update',['post'=>$post->id]) }}" method="post" enctype="multipart/form-data">
                                        @method('PUT')
                                        @else
                                        <form action="{{ route('admin.post.store') }}" method="post" enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="form-body">
                                                <h3 class="card-title">POST SECTION</h3>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Post Title <span style="color: red">*</span></label>
                                                            <input type="text" placeholder="Title" value="{{ old('title',$post->title ?? "") }}" id="title" name="title" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'title'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Post Sub Title </label>
                                                            <input type="text" placeholder="Sub Title" value="{{ old('sub_title',$post->sub_title ?? "") }}" id="sub_title" name="sub_title" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'sub_title'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            @php
                                                            if(isset($post) && isset($post['categories'])){
                                                                $cat = $post['categories']->pluck('id')->toArray();
                                                            }
                                                            @endphp
                                                            <label>Categories <span style="color: red">*</span></label>
                                                            <select class="select2 m-b-10 select2-multiple" name="categories[]" value="" style="width: 100%" multiple="multiple" data-placeholder="Choose Categories">
                                                                <optgroup>
                                                                    @foreach($categories as $category)
                                                                    <option @if(isset($cat) && count($cat) && in_array($category->id,$cat)) selected="" @endif value="{{ $category->id }}">{{ $category->title }}</option>
                                                                    @if(count($category['activeSubCategory']))
                                                                    @foreach($category['activeSubCategory'] as $sub_category)
                                                                    <option @if(isset($cat) && count($cat) && in_array($sub_category->id,$cat)) selected="" @endif value="{{ $sub_category->id }}">~~{{ $sub_category->title }}</option>
                                                                    @endforeach
                                                                    @endif
                                                                    @endforeach
                                                                </optgroup>
                                                            </select>
                                                            @include('admin.includes.form-error',['field'=>'categories'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Slug <span style="color: red">*</span></label>
                                                            <input type="text" placeholder="slug" id="slug" name="slug" value="{{ old('slug',$post->slug ?? "") }}" class="form-control">
                                                            <small class="form-control-feedback"> System generated editable slug</small><br> 
                                                            @include('admin.includes.form-error',['field'=>'slug'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Posted By <span style="color: red">*</span></label><br>
                                                            <select name="pseudonym_id" class="form-control">
                                                                <option value="">Select Name</option>
                                                                @foreach($pseudonyms as $pseudonym)
                                                                <option value="{{ $pseudonym->id }}" {{ (old("pseudonym_id") ?? $post->pseudonym->id ?? "" == $pseudonym->id ? "selected" : "") }}>{{ $pseudonym->title }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @include('admin.includes.form-error',['field'=>'pseudonym_id'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Select Status <span style="color: red">*</span></label>
                                                            <select name="is_published" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="1" @if(isset($post) && $post->is_published==1) {{ 'selected' }} @endif >Publish</option>
                                                                <option value="0" @if(isset($post) &&$post->is_published==0) {{ 'selected' }} @endif >Draft</option>
                                                            </select>
                                                            @include('admin.includes.form-error',['field'=>'is_published'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Add Media <span style="color: red">*</span></label>
                                                            <input type="file" name="media" accept="image/png, image/gif, image/jpeg" >
                                                            {{-- <span class="btn btn-success add_media" data-toggle="modal" data-target=".bs-example-modal-lg" id="add_media">Select Media</span> --}}
                                                            @include('admin.includes.form-error',['field'=>'media'])
                                                            @if(isset($post) && isset($post->media))
                                                            <img src="{{ asset('uploads/mediagallery/'.$post->media) }}" width="100">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group d-none">
                                                            <input type="checkbox" id="is_trending" name="is_trending" value="1" @if(isset($post) && $post->is_trending==1) checked  @endif>
                                                            <label for="is_trending"> Add to Trending</label><br>
                                                            <input type="checkbox" id="is_popular" name="is_popular" value="1" @if(isset($post) && $post->is_popular==1) checked  @endif>
                                                            <label for="is_popular"> Add to Popular</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group d-none">
                                                            <label>Created Date and Time<span style="color: red">*</span></label>
                                                            <input type="text" class="form-control" name="created_date_time" placeholder="set min date" value="{{ old('created_date_time',$post->created_date_time ?? "") }}" id="min-date">
                                                            @include('admin.includes.form-error',['field'=>'created_date_time'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Content <span style="color: red;">*</span></label>
                                                            <textarea class="form-control" id="mymce" name="content" placeholder="content user">{!! old('content') !!} {!! $post->content ?? "" !!}</textarea>
                                                            @include('admin.includes.form-error',['field'=>'content'])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><hr>
                                            <div class="form-body">
                                                <h3 class="card-title">SEO SECTION</h3>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Meta Title</label>
                                                            <input type="text" placeholder="meta title" value="{{ old('meta_title',$post->meta_title ?? "") }}" id="meta_title" name="meta_title" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'meta_title'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Meta Description</label>
                                                            <input type="text" placeholder="meta description" value="{{ old('meta_description',$post->meta_description ?? "") }}" id="meta_description" name="meta_description" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'meta_description'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tags</label><br>
                                                            <input type="text" placeholder="tags" data-role="tagsinput" value="{{ old('tags',$post->tags ?? "") }}" id="tags" name="tags" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'tags'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Open Graph Title</label>
                                                            <input type="text" placeholder="Open graph title" value="{{ old('og_title',$post->og_title ?? "") }}" id="og_title" name="og_title" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'og_title'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Open Graph Description</label>
                                                            <input type="text" placeholder="Open graph description" value="{{ old('og_description',$post->og_description ?? "") }}" id="og_description" name="og_description" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'og_description'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                <a href="{{ route('admin.post.index') }}"><button type="button" class="btn btn-inverse">Cancel</button></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.posts.media-gallery')
    @endsection
