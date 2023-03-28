@php($page_class = 'users')
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
                                href="{{ route('admin.user.survey') }}">Back</a>
                        </div>
                    </div>
                        <div class="container-fluid">
                            <div class="card row">
                                <div class="card-body collapse show">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach($surveys as $survey)
                                            <table class="table table-bordered table-striped">
                                                <tr>
                                                     
                                                 
                                                    
                                                    <td><b>Accredited Investor :</b></td>
                                                    <td>{{ $survey->accredited_investor ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Annual Income :</b></td>
                                                    <td>{{ $survey->annual_income ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Employer :</b></td>
                                                    <td>{{ $survey->employer ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Highest Education :</b></td>
                                                    <td>{{ $survey->highest_education ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Industry Preference :</b></td>
                                                    <td>{{ $survey->industry_preference ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Investment Experience Years :</b></td>
                                                    <td>{{ $survey->investment_experience_years ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Investment Horizon :</b></td>
                                                    <td>{{ $survey->investment_horizon ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Liquidity Preference :</b></td>
                                                    <td>{{ $survey->liquidity_preference ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Married :</b></td>
                                                    <td>{{ $survey->married ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Minimum Investment :</b></td>
                                                    <td>{{ $survey->minimum_investment ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Net Worth :</b></td>
                                                    <td>{{ $survey->net_worth ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Occupation :</b></td>
                                                    <td>{{ $survey->occupation ?: '___'  }}</td>
                                                </tr>

                                                <tr>
                                                    <td><b>Own Property :</b></td>
                                                    <td>{{ $survey->own_property ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Preferred Region :</b></td>
                                                    <td>{{ $survey->preferred_region ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Preferred Strategy :</b></td>
                                                    <td>{{ $survey->preferred_strategy ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Property Zip :</b></td>
                                                    <td>{{ $survey->property_zip ?: '___'  }}</td>
                                                </tr>

                                                <tr>
                                                    <td><b>Risk Tolerance :</b></td>
                                                    <td>{{ $survey->risk_tolerance ?: '___'  }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Target Return :</b></td>
                                                    <td>{{ $survey->target_return ?: '___'  }}</td>
                                                </tr>
                                            </table>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                      
                        @endsection
