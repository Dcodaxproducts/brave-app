@php($page_class = 'pages')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="pull-right btn btn-inline-block btn-info" href="{{ route('admin.page.create') }}">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                    <h4 class="card-title d-inline-block">Pages</h4>
                    <h6 class="card-subtitle">Under this section you will find list of all pages</h6>
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Url</th>
                                    <th>Status</th>
                                    <th>Appearance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->url }}</td>
                                    <td>
                                        @if($page->status==1) <label class="label label-success">Active </label> @else <label class="label label-danger"> Deactive  </label> @endif
                                    </td>
                                    <td>@if($page->appearance==1) 
                                        <label class="label label-success">Header </label> 
                                        @elseif($page->appearance==2)  
                                        <label class="label label-success"> Footer  </label>
                                        @elseif($page->appearance==3)
                                        <label class="label label-success"> Both </label> 
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-info border-0 shadow-none" title="Edit" data-toggle="tooltip" href="{{ route('admin.page.edit',['page'=>$page->id]) }}"><icon class="fa fa-pencil-square-o"></icon></a>

                                        {{-- <form action="{{ route('admin.page.destroy',['page'=>$page->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-outline-danger border-0 shadow-none row-action-btn" title="Delete" data-toggle="tooltip" onclick="this.closest('form').submit();return false;">
                                                <icon class="ti-trash"></icon>
                                            </a>
                                        </form> --}}
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