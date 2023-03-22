@php($page_class = 'settings')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Settings</h4>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-info pull-right m-b-10" href="{{ route('admin.setting.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">{{ $heading_title }} Setting</h4>
                                </div>
                                <div class="card-body">
                                    @if(isset($setting))
                                    <form action="{{ route('admin.setting.update',['setting'=>$setting->id]) }}" method="post" class="form-horizontal form-bordered">
                                        @method('PUT')
                                        @else
                                        <form action="{{ route('admin.setting.store') }}" method="post" class="form-horizontal form-bordered">
                                            @endif
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Key <span style="color: red">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" value="{{ old('key',$setting->key ?? "") }}" name="key" id="key" placeholder="Enter key" class="form-control">
                                                        @include('admin.includes.form-error',['field'=>'key'])
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label text-right col-md-3">Value <span style="color: red">*</span></label>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control" name="value">{!! $setting->value ?? "" !!} {!! old('value') !!}</textarea>
                                                        @include('admin.includes.form-error',['field'=>'value']) 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="offset-sm-3 col-md-9">
                                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Submit</button>
                                                                <a href="{{ route('admin.setting.index') }}"><button type="button" class="btn btn-inverse">Back</button></a>
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
