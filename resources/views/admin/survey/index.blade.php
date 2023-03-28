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
                    <h4 class="card-title d-inline-block">Users survey</h4>
                    <h6 class="card-subtitle">Under this section you will find list of all Users survey</h6>
                    <div class="table-responsive m-t-20">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>User ID</th>
                                    <th>Occupation</th>
                                    <th>Employer</th>
                                    <th>Preferred Strategy</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->user_id }}</td>
                                    <td>{{ $user->occupation }}</td>
                                    <td>{{ $user->employer }}</td>
                                    <td>{{ $user->preferred_strategy }}</td>
                                    <td>
                                    <a href="{{ url('admin/survey/details',[$user->id])}}" class="btn btn-outline-info border-0 shadow-none"> <icon class="fa fa-eye"></icon></a>

                                        {{--<a class="btn btn-outline-info border-0 shadow-none" title="Edit" data-toggle="tooltip" href="{{ route('admin/user/edit',['user'=>$user->id]) }}"><icon class="fa fa-pencil-square-o"></icon></a>

                                        <form action="{{ route('admin.user.destroy',['user'=>$user->id]) }}" method="get">
                                          
                                            @method('DELETE')
                                            <a href="#" class="btn btn-outline-danger border-0 shadow-none row-action-btn" title="Delete" data-toggle="tooltip" onclick="this.closest('form').submit();return false;">
                                                <icon class="ti-trash"></icon>
                                            </a>--}}
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

<div class="modal fade zoom" tabindex="-1" id="UserSurveyModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><label class="user_survey_modal_title"></label></h5>
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
    	$(document).on('click','.view_user_survey', function() {
		let user_id = $(this).data('id');
		var url = $(this).data('url');
		showUserSurvey(user_id,url);
	}); 

	function showUserSurvey(user_id,url)
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
				$('.user_survey_modal_title').html('User Survey Details')
				let user_response = `
				<div class="container-fluid">
				<div class="card row">
				<div class="card-body collapse show">
				<div class="row">
				<div class="col-md-12">
				<table class="table table-bordered table-striped">
				<tr>
				<td><b>Accredited Investor :</b></td>
				<td>${user.accredited_investor}</td>
				</tr>
				<tr>
				<td><b>Annual Income :</b></td>
				<td>${user.annual_income}</td>
				</tr>
				<tr>
				<td><b>Employer :</b></td>
				<td>${user.employer}</td>
				</tr>
				<tr>
				<td><b>Highest Education :</b></td>
				<td>${user.highest_education}</td>
				</tr>
				<tr>
				<td><b>Industry Preference :</b></td>
				<td>${user.industry_preference}</td>
				</tr>
				<tr>
				<td><b>Investment Experience Years :</b></td>
				<td>${user.investment_experience_years}</td>
				</tr>
				<tr>
				<td><b>Investment Horizon :</b></td>
				<td>${user.investment_horizon}</td>
				</tr>
				<tr>
				<td><b>Liquidity Preference :</b></td>
				<td>${user.liquidity_preference}</td>
				</tr>
				<tr>
				<td><b>Married :</b></td>
				<td>${user.married}</td>
				</tr>
				<tr>
				<td><b>Minimum Investment :</b></td>
				<td>${user.minimum_investment}</td>
				</tr>
                <tr>
				<td><b>Net Worth :</b></td>
				<td>${user.net_worth}</td>
				</tr>
				<tr>
				<td><b>Occupation :</b></td>
				<td>${user.occupation}</td>
				</tr>

                <tr>
				<td><b>Own Property :</b></td>
				<td>${user.own_property}</td>
				</tr>
				<tr>
				<td><b>Preferred Region :</b></td>
				<td>${user.preferred_region}</td>
				</tr>
				<tr>
				<td><b>Preferred Strategy :</b></td>
				<td>${user.preferred_strategy}</td>
				</tr>
                <tr>
				<td><b>Property Zip :</b></td>
				<td>${user.property_zip}</td>
				</tr>
				
                <tr>
				<td><b>Risk Tolerance :</b></td>
				<td>${user.risk_tolerance}</td>
				</tr>
				<tr>
				<td><b>Target Return :</b></td>
				<td>${user.target_return}</td>
				</tr>
			`

				
				$('.modal-body').html(user_response);
				$('#UserSurveyModal').modal('toggle');
			}
		});
	}
</script>
@endsection