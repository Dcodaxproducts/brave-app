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
                                href="{{ route('admin.questions.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-gradient-primary">
                                    <h4 class="m-b-0 text-white">Survey Questions & Answers</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.questions.update') }}" method="post"
                                        enctype="multipart/form-data">

                                        @csrf
                                       
                                        <div class="form-body">
                                          
                                            <hr>
                                              
                                            <div class="row">
                                           
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Question</label>
                                                     
                                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                                        <input type="text" placeholder="Name" name="name"
                                                            class="form-control" value="{{ $data->question }}">
                                                    </div>
                                           
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Question Description <i style="color:green;">Optional</i></label>
                                                     
                                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                                        <input type="text" placeholder="Name" name="name"
                                                            class="form-control" value="{{ $data->question }}">
                                                    </div>
                                           
                                                </div>

                                                <div class="col-md-12">
                                                @foreach($answers as $answer)
                                                <label>Answers</label>
                                                <input type="text" placeholder="Answers" name="answers[]" value="{{ $answer }}" class="form-control">
                                                @endforeach
                                            </div>

                                       
                                            
                                        </div>
                                        <hr>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                                Update</button>
                                            <a href="{{ route('admin.questions.index') }}"><button
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
