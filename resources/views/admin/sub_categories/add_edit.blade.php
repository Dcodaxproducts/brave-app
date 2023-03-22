@php($page_class = 'sub_category')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Sub Categories</h4>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-info pull-right m-b-10" href="{{ route('admin.sub_category.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">{{ $heading_title }} Sub Category</h4>
                                </div>
                                <div class="card-body">
                                    @if(isset($sub_category))
                                    <form action="{{ route('admin.sub_category.update',['sub_category'=>$sub_category->id]) }}" method="post" class="form-horizontal form-bordered">
                                        @method('PUT')
                                        @else
                                        <form action="{{ route('admin.sub_category.store') }}" method="post" class="form-horizontal form-bordered">
                                            @endif
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Select category <span style="color: red">*</span></label>
                                                    <div class="col-md-9">
                                                        <select name="parent_id" class="form-control">
                                                            <option value="">Select Category</option>
                                                            @foreach($categories as $category)
                                                            @if(isset($sub_category))
                                                            <option value="{{ $category->id }}" {{ ($sub_category ? $sub_category->parent_id : "" == $category->id) ? "selected" : "" }} {{ (old("parent_id") == $category->id ? "selected":"") }}>{{ $category->title }}</option>
                                                            @else
                                                            <option value="{{ $category->id }}" {{ (old("parent_id") == $category->id ? "selected":"") }}>{{ $category->title }}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        @include('admin.includes.form-error',['field'=>'parent_id'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Title <span style="color: red">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{ old('title',$sub_category->title ?? "") }}" name="title" id="title" placeholder="Enter title" class="form-control">
                                                        @include('admin.includes.form-error',['field'=>'title'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Slug <span style="color: red;">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{ old('slug',$sub_category->slug ?? "") }}" id="slug" name="slug" placeholder="slug" class="form-control">
                                                        <small class="form-control-feedback"> System generated editable slug</small><br> 
                                                        @include('admin.includes.form-error',['field'=>'slug'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Description</label>
                                                    <div class="col-md-9">
                                                        <textarea id="mymce" value="{!! old('description') !!}" name="description">{!! $sub_category->description ?? "" !!}</textarea>
                                                        <small class="form-control-feedback"> Optional</small> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="offset-sm-3 col-md-9">
                                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                                                <a href="{{ route('admin.sub_category.index') }}"><button type="button" class="btn btn-inverse">Back</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
