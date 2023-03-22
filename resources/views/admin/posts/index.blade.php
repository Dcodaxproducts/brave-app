@php($page_class = 'users')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="pull-right btn btn-inline-block btn-info" href="{{ route('admin.post.create') }}">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                    <h4 class="card-title d-inline-block">Posts</h4>
                    <h6 class="card-subtitle">Under this section you will find list of all posts</h6>
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Posted By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    @if($post['categories'])
                                    <td>
                                    @foreach($post['categories'] as $category)
                                    {{ $category->title }}
                                    @if($category->subCategory)
                                    {{-- @foreach($category->subCategory as $sub_category)
                                    <ul>
                                        <li>
                                            {{ $sub_category->title }}
                                        </li>
                                    </ul>
                                    @endforeach --}}
                                    @endif
                                    @endforeach
                                    </td>
                                    @endif
                                    <td>{{ $post->description }}</td>
                                    <td>@if($post->is_published==1) <label class="label label-success">Published </label> @else <label class="label label-danger"> Drafted  </label> @endif
                                    </td>
                                    <td>{{ $post['pseudonym']->title ?? "" }}</td>
                                    <td>
                                        <a class="btn btn-outline-info border-0 shadow-none" title="Edit" data-toggle="tooltip" href="{{ route('admin.post.edit',['post'=>$post->id]) }}"><icon class="fa fa-pencil-square-o"></icon></a>

                                        <form action="{{ route('admin.post.destroy',['post'=>$post->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="btn btn-outline-danger border-0 shadow-none row-action-btn" title="Delete" data-toggle="tooltip" onclick="this.closest('form').submit();return false;">
                                                <icon class="ti-trash"></icon>
                                            </a>
                                        </form>

                                        {{-- <a class="btn btn-outline-danger border-0 shadow-none row-action-btn" onclick="return confirm('Are you sure you want to delete the record')" href="{{ route('admin.post.destroy',['post'=>$post->id]) }}">
                                            <icon class="ti-trash"></icon>
                                        </a> --}}
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