@php($page_class = 'users')
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{--<a class="pull-right btn btn-inline-block btn-info" href="{{ route('admin.user.create') }}">
                        <i class="fa fa-plus"></i> Add New
                    </a>--}}
                    <h4 class="card-title d-inline-block">Users</h4>
                    <h6 class="card-subtitle">Under this section you will find list of all users</h6>
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
									<th>Survey <br>
									completed <br>
										or not</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name ?: '___' }}</td>
                                    <td>{{ $user->email ?: '___' }}</td>
                                    <td>{{ $user->phone ?: '___' }}</td>
									<td>{{ $user->survey_complete ?: '___' }}</td>
                                    <td>
									{{--<a href="#" class="view_user btn btn-outline-info border-0 shadow-none" title="View" data-toggle="tooltip" data-id="{{ $user->id }}" data-url="{{ url('admin/user/details',[$user->id])}}"> <icon class="fa fa-eye"></icon></a>
                                        <br>
                                        <a class="btn btn-outline-info border-0 shadow-none" title="Edit" data-toggle="tooltip" href="{{ url('admin/user/edit',[$user->id]) }}"><icon class="fa fa-pencil-square-o"></icon></a>
                                        <br>
                                        <span>--}}
                                        <form action="{{ url('admin/user/delete', [$user->id]) }}" method="get">
                                            <a href="#" class="btn btn-outline-danger border-0 shadow-none row-action-btn" title="Delete" data-toggle="tooltip" onclick="this.closest('form').submit();return false;">
                                                <icon class="ti-trash"></icon>
                                            </a>
                                        </form>
                                    </span>
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
<div class="modal fade zoom" tabindex="-1" id="UserModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><label class="order_modal_title"></label></h5>
				<a href="#" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-xmark" style="color: black;">x</i>
				</a>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer bg-light">
			</div>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    	$(document).on('click','.view_user', function() {
		let user_id = $(this).data('id');
		var url = $(this).data('url');
		showUser(user_id,url);
	});

	function showUser(user_id,url)
	{
		$.ajax({
			type: "get",
			url: url,
			data: {
				"_token": "{{ csrf_token() }}",
				'user':user_id
			},
			success: function(response){
                console.log();
				var user = response[0];
				console.log("response ",user)
				$('.order_modal_title').html('User Details')
				let user_response = `
				<div class="container-fluid">
				<div class="card row">
				<div class="card-body collapse show">
				<div class="row">
				<div class="col-md-12">
				<table class="table table-bordered table-striped">
				<tr>
				<td><b>ID :</b></td>
				<td>${user.id}</td>
				</tr>
				<tr>
				<td><b>User First Name :</b></td>
				<td>${user.first_name}</td>
				</tr>
				<tr>
				<td><b>User Last Name :</b></td>
				<td>${user.last_name}</td>
				</tr>
				<tr>
				<td><b>Phone Number :</b></td>
				<td>${user.phoneNumber}</td>
				</tr>
				<tr>
				<td><b>Email :</b></td>
				<td>${user.email}</td>
				</tr>
				<tr>
				<td><b>Address Line 1 :</b></td>
				<td>${user.address_line_1}</td>
				</tr>
				<tr>
				<td><b>Address Line 2 :</b></td>
				<td>${user.address_line_2}</td>
				</tr>
				<tr>
				<td><b>Birthday :</b></td>
				<td>${user.birthday}</td>
				</tr>
				<tr>
				<td><b>City :</b></td>
				<td>${user.city}</td>
				</tr>
				<tr>
				<td><b>Country :</b></td>
				<td>${user.country}</td>
				</tr>
                <tr>
				<td><b>Zip Code :</b></td>
				<td>${user.zip_code}</td>
				</tr>
				<tr>
				<td><b>Survey Completed or Not? :</b></td>
				<td>${user.survey_complete}</td>
				</tr>
				
			`

				
				$('.modal-body').html(user_response);
				$('#UserModal').modal('toggle');
			}
		});
	}
</script>
@endsection