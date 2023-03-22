@php($page_class = 'pseudonyms')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="pull-right btn btn-inline-block btn-info" href="{{ route('admin.pseudonym.create') }}">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                    <h4 class="card-title d-inline-block">Pseudonym</h4>
                    <h6 class="card-subtitle">Under this section you will find list of all pseudonyms</h6>
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pseudonyms as $pseudonym)
                                <tr>
                                    <td>{{ $pseudonym->user->full_name }}</td>
                                    <td>{{ $pseudonym->title }}</td>
                                    <td>{!! $pseudonym->notes !!}</td>
                                    <td>
                                        <a class="btn btn-outline-info border-0 shadow-none" title="Edit" data-toggle="tooltip" href="{{ route('admin.pseudonym.edit',['pseudonym'=>$pseudonym->id]) }}">
                                            <icon class="fa fa-pencil-square-o"></icon>
                                        </a>
                                        <form action="{{ route('admin.pseudonym.destroy',['pseudonym'=>$pseudonym->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
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