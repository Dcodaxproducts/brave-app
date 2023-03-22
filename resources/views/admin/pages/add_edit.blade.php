@php($page_class = 'pages')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Pages</h4>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-info pull-right m-b-10" href="{{ route('admin.page.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">{{ $heading_title }} Page</h4>
                                </div>
                                <div class="card-body">
                                    @if(isset($page))
                                    <form action="{{ route('admin.page.update',['page'=>$page->id]) }}" method="post">
                                        @method('PUT')
                                        @else
                                        <form action="{{ route('admin.page.store') }}" method="post">
                                            @endif
                                            @csrf
                                            <div class="form-body">
                                                <h3 class="card-title">PAGE SECTION</h3>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Page title <span style="color: red">*</span></label>
                                                            <input type="text" placeholder="title" name="title" value="{{ old('title',$page->title ?? "") }}" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'title'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Page Url <span style="color: red">*</span></label>
                                                            <input type="text" placeholder="url" name="url" value="{{ old('url',$page->url ?? "") }}" class="form-control">
                                                            {{-- <input type="hidden" value="{{ old('url',$page->url ?? "") }}" name="url"> --}}
                                                            @include('admin.includes.form-error',['field'=>'url'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Page Appearance <span style="color: red">*</span></label>
                                                            <select name="appearance" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="1" @if(old('appearance',($page ?? "") ? $page->appearance : "" ?? "")=="1") {{ 'selected' }} @endif >Header</option>
                                                                <option value="2" @if(old('appearance',($page ?? "") ? $page->appearance : "" ?? "")=="2") {{ 'selected' }} @endif >Footer</option>
                                                                <option value="3" @if(old('appearance',($page ?? "") ? $page->appearance : "" ?? "")=="3") {{ 'selected' }} @endif >Both</option>
                                                            </select>
                                                            @include('admin.includes.form-error',['field'=>'appearance'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Page Status <span style="color: red">*</span></label>
                                                            <select name="status" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="1" @if(old('status',($page ?? "") ? $page->status : "" ?? "")=="1") {{ 'selected' }} @endif >Active</option>
                                                                <option value="2" @if(old('status',($page ?? "") ? $page->status : "" ?? "")=="2") {{ 'selected' }} @endif >Deactive</option>
                                                            </select>
                                                            @include('admin.includes.form-error',['field'=>'appearance'])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <h3 class="card-title">SEO SECTION</h3>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Meta Title</label>
                                                            <input type="text" placeholder="meta title"value="{{ old('meta_title',$page->meta_title ?? "") }}" id="meta_title" name="meta_title" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'meta_title'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Meta Description</label>
                                                            <input type="text" placeholder="meta description" name="meta_description" value="{{ old('meta_description',$page->meta_description ?? "") }}" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'meta_description'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Tags</label><br>
                                                            <input type="text" placeholder="tags" data-role="tagsinput" value="{{ old('tags',$page->tags ?? "") }}" id="tags" name="tags" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'tags'])
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Open Graph Title</label>
                                                            <input type="text" placeholder="open graph title"value="{{ old('og_title',$page->og_title ?? "") }}" id="og_title" name="og_title" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'og_title'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Open Graph Description</label>
                                                            <input type="text" placeholder="open graph description" name="og_description" value="{{ old('og_description',$page->og_description ?? "") }}" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'og_description'])
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                <a href="{{ route('admin.page.index') }}"><button type="button" class="btn btn-inverse">Cancel</button></a>
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
    @endsection
