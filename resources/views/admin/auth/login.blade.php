<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="login-box card d-flex justify-content-center" style="margin-top:20%;">
                    <div class="card-body">
                        <form class="form-horizontal form-material" id="loginform" method="post"
                            action="{{ route('admin.auth.authenticate') }}">
                            {{ csrf_field() }}
                            <h3 class="box-title m-b-20">Sign In</h3>
                            @include('admin.includes.message')
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" value="{{ old('email') }}"
                                        type="email" name="email" required="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" name="password" type="password" required=""
                                        placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="checkbox checkbox-info pull-left p-t-0">
                                        <input id="checkbox-signup" type="checkbox" name="remember"
                                            class="filled-in chk-col-light-blue">
                                        <label for="checkbox-signup"> Remember me </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="col-xs-12 p-b-20">
                                    <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log
                                        In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

    </div>
    @include('admin.includes.scripts')
    @yield('footer-scripts')
</body>

</html>
