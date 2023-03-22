@php($page_class = 'category')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a class="pull-right btn btn-inline-block btn-info" href="{{ route('admin.category.create') }}">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                    <h4 class="card-title d-inline-block">Categories</h4>
                    <h6 class="card-subtitle">Under this section you will find list of all categories</h6>
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Update status</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->title }}</td>
                                    <td>@if($category->is_active==1) <label class="label label-success">Active </label> @else <label class="label label-danger"> Deactive  </label> @endif</td>
                                    <td>
                                        <div class="switch">
                                            <label>
                                                <input type="checkbox" class="cat_status" data-id="{{ $category->id }}" @if($category->is_active==1) checked @endif>
                                                <span class="lever switch-col-light-blue"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{!! $category->description !!}</td>
                                    <td>
                                        <a class="btn btn-outline-info border-0 shadow-none" title="Edit" data-toggle="tooltip" href="{{ route('admin.category.edit',['category'=>$category->id]) }}">
                                            <icon class="fa fa-pencil-square-o"></icon>
                                        </a>
                                        <form action="{{ route('admin.category.destroy',['category'=>$category->id]) }}" method="post">
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
@section('footer-scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.cat_status',function(){
            var id = $(this).data('id');
            var checkbox = $(this);
            swal({   
                title: "Are you sure?",   
                text: "You want to update category status",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes",   
                cancelButtonText: "No",   
                closeOnConfirm: true,   
                closeOnCancel: false 
            }, function(isConfirm){   
                if (isConfirm) {
                    $.ajax({
                        data:{
                            id: id,
                        },
                        type:"get", 
                        url: "{{ route('admin.category.update_status') }}",
                        success: function(data){
                            if(data.status==1){
                                swal("Updated!", "Status updated successfully.", "success");  
                                window.setTimeout(function(){location.reload()},2000)
                            }
                        }
                    });    
                } 
                else { 
                    swal("Cancelled", "Status not updated :)", "error");   
                    if(checkbox.prop("checked") == false){
                        checkbox.prop("checked",true);
                    }
                    if(checkbox.prop("checked") == true){
                        checkbox.prop("checked",false);
                    }
                } 
            });
        });
    });
</script>
@endsection