@extends('admin.layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-info pull-right m-b-10"
                                href="{{ route('admin.partners.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white"> Partners</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.partners.update') }}" method="post"
                                        enctype="multipart/form-data">

                                        @csrf
                                        @foreach($partners as $partner)
                                        <div class="form-body">
                                            <h3 class="card-title">PARTNERS SECTION</h3>
                                            <hr>
                                              
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Partner Name</label>
                                                        <input type="hidden" name="id" value="{{ $partner->id }}">
                                                        <input type="text" placeholder="Name" name="name"
                                                            class="form-control" value="{{ $partner->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Website URL </label>
                                                        <input type="text" placeholder="Website URL" name="website_url" value="{{ $partner->website_url }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Partner Description</label>
                                                        <textarea class="form-control" rows="3" name="description">{{ $partner->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                                Update</button>
                                            <a href="{{ route('admin.partners.index') }}"><button
                                                    type="button" class="btn btn-inverse">Cancel</button></a>
                                        </div>
                                    @endforeach
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
