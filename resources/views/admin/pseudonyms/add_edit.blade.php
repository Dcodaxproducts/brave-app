@php($page_class = 'pseudonyms')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Pseudonym</h4>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-info pull-right m-b-10" href="{{ route('admin.pseudonym.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">{{ $heading_title }} Pseudonym</h4>
                                </div>
                                <div class="card-body">
                                    @if(isset($pseudonym))
                                    <form action="{{ route('admin.pseudonym.update',['pseudonym'=>$pseudonym->id]) }}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                        @method('PUT')
                                        @else
                                        <form action="{{ route('admin.pseudonym.store') }}" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Select User <span style="color: red">*</span></label>
                                                    <div class="col-md-9">
                                                        <select name="user_id" class="form-control">
                                                            <option value="">Select User</option>
                                                            @foreach($users as $user)
                                                            @if(isset($pseudonym))
                                                            <option value="{{ $user->id }}" {{ ($pseudonym ? $pseudonym->user_id : "" == $user->id) ? "selected" : "" }} {{ (old("user_id") == $user->id ? "selected":"") }}>{{ $user->full_name }}</option>
                                                            @else
                                                            <option value="{{ $user->id }}" {{ (old("user_id") == $user->id ? "selected":"") }}>{{ $user->full_name }}
                                                            </option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        @include('admin.includes.form-error',['field'=>'user_id'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Title <span style="color: red">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{ old('title',$pseudonym->title ?? "") }}" name="title" id="title" placeholder="Enter title" class="form-control">
                                                        @include('admin.includes.form-error',['field'=>'title'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Slug <span style="color: red;">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{ old('slug',$pseudonym->slug ?? "") }}" id="slug" name="slug" placeholder="slug" class="form-control">
                                                        <small class="form-control-feedback"> System generated editable slug</small><br> 
                                                        @include('admin.includes.form-error',['field'=>'slug'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Image <span style="color: red;">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="file" name="media"><br> 
                                                        @include('admin.includes.form-error',['field'=>'media'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Facebook <span style="color: red;">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{ old('facebook',$pseudonym->facebook ?? "") }}" name="facebook" placeholder="facebook" class="form-control"><br> 
                                                        @include('admin.includes.form-error',['field'=>'facebook'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Twitter <span style="color: red;">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{ old('twitter',$pseudonym->twitter ?? "") }}" name="twitter" placeholder="twitter" class="form-control"><br> 
                                                        @include('admin.includes.form-error',['field'=>'twitter'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Linkedin <span style="color: red;">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{ old('linkedin',$pseudonym->linkedin ?? "") }}" name="linkedin" placeholder="linkedin" class="form-control"><br> 
                                                        @include('admin.includes.form-error',['field'=>'linkedin'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Reddit</label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{ old('reddit',$pseudonym->reddit ?? "") }}" name="reddit" placeholder="reddit" class="form-control"><br> 
                                                        @include('admin.includes.form-error',['field'=>'reddit'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Notes</label>
                                                    <div class="col-md-9">
                                                        <textarea id="mymce" name="notes">{!! $pseudonym->notes ?? "" !!} {!! old('notes') !!}</textarea>
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
                                                                <a href="{{ route('admin.pseudonym.index') }}"><button type="button" class="btn btn-inverse">Back</button></a>
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
