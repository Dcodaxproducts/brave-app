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
                                href="{{ route('admin.faqs.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-gradient-primary">
                                    <h4 class="m-b-0 text-white"> Faqs</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.faqs.update') }}" method="post"
                                        enctype="multipart/form-data">

                                        @csrf
                                        @foreach($faqs as $faq)
                                        <div class="form-body">
                                           
                                            <hr>
                                          
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Question</label>
                                                        <input type="hidden" name="id" value="{{ $faq->id }}">
                                                        <input type="text" placeholder="Question" name="question"
                                                            class="form-control" value="{{ $faq->question }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Answer</label>
                                                        <input type="text" placeholder="Answer" name="answer"
                                                            class="form-control" value="{{ $faq->answer }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                                Update</button>
                                            <a href="{{ route('admin.faqs.index') }}"><button
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
