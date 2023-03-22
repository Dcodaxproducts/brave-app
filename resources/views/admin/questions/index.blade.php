@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="pull-right btn btn-inline-block btn-info" href="{{ route('admin.questions.create') }}">
                        <i class="fa fa-plus"></i> Add New Survey Questions & Answers
                    </a>
                    <h4 class="card-title d-inline-block">Survey Questions & Answers</h4>
                    <h6 class="card-subtitle">Under this section you will find list of all Survey Questions & Answers</h6>
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Question</th>
                                    <th>Answers</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $question)
                                <tr>
                                    <td>{{ $question->id }}</td>
                                    <td>{{ $question->question ?: '___' }}</td>
                                    <td>{{ $question->answers ?: '___' }}</td>
                                    <td>{{ $question->created_at ?: '___' }}</td>
                                    <td>{{ $question->updated_at ?: '___' }}</td>
                                    <td>
                                        <a class="btn btn-outline-info border-0 shadow-none" title="Edit" data-toggle="tooltip" href="{{ url('admin/questions/edit',[$question->id]) }}"><icon class="fa fa-pencil-square-o"></icon></a>
                                        
                                        <form action="{{ url('admin/questions/delete', [$question->id]) }}" method="get">
                                            <a href="#" class="btn btn-outline-danger border-0 shadow-none row-action-btn" title="Delete" data-toggle="tooltip" onclick="this.closest('form').submit();return false;">
                                                <icon class="ti-trash"></icon>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection