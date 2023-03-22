@php($page_class = 'users')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Users</h4>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-info pull-right m-b-10" href="{{ route('admin.user.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">{{ $heading_title }} User</h4>
                                </div>
                                <div class="card-body">
                                    @if(isset($user))
                                    <form action="{{ route('admin.user.update',['user'=>$user->id]) }}" method="post">
                                        @method('PUT')
                                        @else
                                        <form action="{{ route('admin.user.store') }}" method="post">
                                            @endif
                                            @csrf
                                            <div class="form-body">
                                                <h3 class="card-title">Personal Information</h3>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>First Name <span style="color: red">*</span></label>
                                                            <input type="text" placeholder="First Name" value="{{ old('first_name',$user->first_name ?? "") }}" id="first_name" name="first_name" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'first_name'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Last Name <span style="color: red">*</span></label>
                                                            <input type="text" placeholder="Last Name" name="last_name" value="{{ old('first_name',$user->first_name ?? "") }}" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'last_name'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Slug <span style="color: red">*</span></label>
                                                            <input type="text" placeholder="slug" id="slug" name="slug" value="{{ old('slug',$user->slug ?? "") }}" class="form-control">
                                                            <small class="form-control-feedback"> System generated editable slug</small><br> 
                                                            @include('admin.includes.form-error',['field'=>'slug'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Password <span style="color: red">*</span></label>
                                                            <input type="password" placeholder="Password" name="password" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'password'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Select User Status <span style="color: red">*</span></label>
                                                            <select name="status" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="1" @if(old('status',($user) ? $user->status : "" ?? "")=="1") {{ 'selected' }} @endif >Active</option>
                                                                <option value="2" @if(old('status',($user) ? $user->status : "" ?? "")=="2") {{ 'selected' }} @endif >Deactive</option>
                                                                <option value="3" @if(old('status',($user) ? $user->status : "" ?? "")=="3") {{ 'selected' }} @endif >Blocked</option>
                                                            </select>
                                                            @include('admin.includes.form-error',['field'=>'status'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Select User Verification <span style="color: red">*</span></label><br>
                                                            <select name="is_verified" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="1" @if(old('is_verified',($user) ? $user->is_verified : "" ?? "")=="1") {{ 'selected' }} @endif>Verified</option>
                                                                <option value="0" @if(old('is_verified',($user) ? $user->is_verified : "" ?? "")=="0") {{ 'selected' }} @endif>Not verified</option>
                                                            </select>
                                                            @include('admin.includes.form-error',['field'=>'is_verified'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Email <span style="color: red">*</span></label>
                                                            <input type="email" placeholder="Email" value="{{ old('email',$user->email ?? "") }}"  name="email" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'email'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input type="text" placeholder="Phone" name="phone" class="form-control" value="{{ old('phone',$user->phone ?? "") }}">
                                                            @include('admin.includes.form-error',['field'=>'phone'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Select Role <span style="color: red">*</span></label><br>
                                                            <select name="role_id" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="1" @if(old('role_id',($user) ? $user->role_id : "" ?? "")=="1") {{ 'selected' }} @endif>Admin</option>
                                                                <option value="2" @if(old('role_id',($user) ? $user->role_id : "" ?? "")=="2") {{ 'selected' }} @endif>Writer</option>
                                                            </select>
                                                            @include('admin.includes.form-error',['field'=>'role_id'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>About</label>
                                                            <textarea class="form-control" id="mymce" name="about" placeholder="About user">{!! old('about') !!} {!! $user->about ?? "" !!}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><hr>
                                            <div class="form-body">
                                                <h3 class="card-title">Social Media Details</h3>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Facebook</label>
                                                            <input type="text" placeholder="Facebook link"value="{{ old('facebook',$user->facebook ?? "") }}" id="facebook" name="facebook" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'facebook'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Twitter</label>
                                                            <input type="text" placeholder="Twitter link" name="twitter" value="{{ old('twitter',$user->twitter ?? "") }}" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'twitter'])
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Linkedin</label>
                                                            <input type="text" placeholder="Linkedin link"value="{{ old('linkedin',$user->linkedin ?? "") }}" id="linkedin" name="linkedin" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'linkedin'])
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Reddit</label>
                                                            <input type="text" placeholder="Reddit link" name="reddit" value="{{ old('reddit',$user->reddit ?? "") }}" class="form-control">
                                                            @include('admin.includes.form-error',['field'=>'reddit'])
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                <a href="{{ route('admin.user.index') }}"><button type="button" class="btn btn-inverse">Cancel</button></a>
                                                {{-- <a href="{{ route('admin.user.permissions') }}"><button type="button" class="btn btn-inverse">Permissions</button></a> --}}
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
