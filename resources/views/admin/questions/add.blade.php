@extends('admin.layouts.app')

@section('content')
<style>
    .entry:not(:first-of-type) {
        margin-top: 10px;
    }

    .glyphicon {
        font-size: 15px;
    }

</style>
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
                                href="{{ route('admin.questions.index') }}">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white"> questions</h4>
                                </div>
                                <div class="card-body ">

                                    <form action="{{ route('admin.questions.store') }}" method="post"
                                        enctype="multipart/form-data" role="form">

                                        @csrf
                                        <div class="form-body dynamic-wrap">
                                            <h3 class="card-title">SURVEY QUESTIONS & ANSWERS</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Question</label>
                                                        <input type="text" placeholder="Write question here.." name="question"
                                                            class="form-control">
                                                            @if ($errors->has('question'))
                                                                <div class="alert alert-danger mt-2">{{ $errors->first('question') }}</div>
                                                            @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Answer</label>

                                                    <div class="here">
                                                        <div class="entry input-group">
                                                            <input class="form-control" name="answers[]" type="text"
                                                                placeholder="Write option" />
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-success btn-add" type="button">
                                                                    <span
                                                                        class="glyphicon glyphicon-plus fa fa-plus"></span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                                                Save</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(function () {
        $(document).on('click', '.btn-add', function (e) {
            e.preventDefault();
            console.log("here");
            var dynaForm = $('.dynamic-wrap .here:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(dynaForm);

            newEntry.find('input').val('');
            dynaForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove ti-trash')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus"></span>');
        }).on('click', '.btn-remove', function (e) {
            $(this).parents('.entry:first').remove();

            e.preventDefault();
            return false;
        });
    });

</script>
@endsection
