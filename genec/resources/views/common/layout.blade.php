<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="{{ asset('static/assets/img/favicon.ico') }}">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('static/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('static/assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('static/assets/css/signin.css')  }}" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]>
    <scripts src="{{ asset('static/assets/js/ie8-responsive-file-warning.js') }}"></scripts><![endif]-->
    <script src="{{ asset('static/assets/js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <scripts src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></scripts>
    <scripts src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></scripts>
    <![endif]-->
    @yield('css')
</head>

<body>
@section('body')
<div class="container">
    @section('form')
    <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">@yield('form_title')</h2>
        {{ csrf_field() }}
        <label for="inputEmail" class="sr-only">Email address</label>
        @section('login_name')
        <input type="text" id="number" name="number" value="{{ old('number') }}" class="form-control" placeholder="工号" required autofocus>
        @show
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="密码" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> 记住我
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登录</button>
        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                {{-- <a class="btn btn-link" href="regist.html">申请人注册</a> --}}
                @yield('register')
            </div>
            <div class="col-md-6 col-sm-6" style="text-align: right;">
                <a class="btn btn-link" data-toggle="modal" data-target="#find_password">忘记密码</a>
            </div>
        </div>
        <br>
        @if (Session::has('error'))
            <p class="bg-danger" style="padding:15px; text-align: center">{{ Session::get('error') }}</p>
        @endif
    </form>
    @show
</div> <!-- /container -->
<div id="find_password" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">请输入注册邮箱找回密码</h4>
            </div>
            <div class="modal-body">
                <form action="#" class="form-inline">
                    <input class="form-control input-lg" type="email" placeholder="注册邮箱" required autofocus>
                    <button type="submit" class="btn btn-lg btn-success">找回</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@show

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('static/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('static/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('static/assets/js/ie10-viewport-bug-workaround.js') }}"></script>
@yield('javascript')
</body>
</html>
