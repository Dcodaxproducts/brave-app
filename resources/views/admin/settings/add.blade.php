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
                            <a class="btn bg-gradient-primary pull-right m-b-10"
                                href="{{ route('admin.settings.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-gradient-primary">
                                    <h4 class="m-b-0 text-white"> settings</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.settings.store') }}" method="post"
                                        enctype="multipart/form-data">

                                        @csrf
                                        <div class="form-body">
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Key Name</label>
                                                        <input type="text" placeholder="Key Name" name="key"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Details</label>
                                                        <textarea class="form-control" rows="3" name="details" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                                Save</button>
                                            <a href="{{ route('admin.settings.index') }}"><button
                                                    type="button" class="btn btn-inverse">Cancel</button></a>
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
