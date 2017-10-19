@extends('common.layout')
@section('title','中国基因行业标准化技术委员会申报系统')

@section('form_title','中国基因行业标准化<br>技术委员会申报系统')

@section('css')
    <link href="{{ asset('static/assets/css/signin.css')  }}" rel="stylesheet">
    <style>
        body {
            padding-top: 0;
        }
    </style>
@endsection

@section('form')
    <form id="signForm" class="form-signin" method="post" action="" style="max-width: 600px" onsubmit="return check()">
        <h2 class="form-signin-heading">申报系统申报人注册</h2>
        <br>
        {{ csrf_field() }}
        <label for="inputName">真实姓名</label>
        <div class="row">
            <div class="col-sm-8">
                <input type="text" id="inputName" name="name" class="form-control" placeholder="真实姓名" value="{{ old('name') }}" autofocus>
            </div>
            <div class="col-sm-4"><p id="inputName"></p></div>
        </div>
        <label for="inputEmail">邮箱</label>
        <div class="row">
            <div class="col-sm-8">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="邮箱" value="{{ old('email') }}" autofocus>
            </div>
            <div class="col-sm-4"><p id="inputEmail"></p></div>
        </div>
        <label for="inputPhone">手机号</label>
        <div class="row">
            <div class="col-sm-8">
                <input type="number" id="inputPhone" name="phone" class="form-control" placeholder="手机号" value="{{ old('phone') }}" autofocus>
            </div>
            <div class="col-sm-4">
                <p id="inputPhone"></p>
            </div>
        </div>
        <label for="sex">性别</label>
        <div class="row" style="margin-bottom: 8px">
            <div class="col-sm-12">
                <input type="radio" name="sex" id="sex" value="1" @if(old('sex'))checked @endif> 男
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="sex" id="sex" value="0" @if(!old('sex'))checked @endif> 女
            </div>
        </div>
        <label for="inputPassword">密码</label>
        <div class="row">
            <div class="col-sm-8">
                <input type="password" id="password" name='password' class="form-control" value="{{ old('password') }}" placeholder="密码">
            </div>
            <div class="col-sm-4">
                <p id="password"></p>
            </div>
        </div>
        <label for="inputConfirmPassword">确认密码</label>
        <div class="row">
            <div class="col-sm-8">
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" value="{{ old('confirm_password') }}" placeholder="确认密码">
            </div>
            <div class="col-sm-4">
                <p id="confirm_password"></p>
            </div>
        </div>
        <div class="col-sm-8">
            <button class="btn btn-lg btn-primary btn-block" type="submit">注册</button></div>
        <div class="form-group">
            <div class="col-sm-6 col-sm-6">
                <a class="btn btn-link" href="{{ route('proposer_login') }}">已有账号点击登录</a>
            </div>
        </div>
        @if (Session::has('error'))
            <div class="row">
                <div class="col-sm-8">
                    <p class="bg-danger" style="padding:15px; text-align: center">{{ Session::get('error') }}</p>
                </div>
            </div>
        @endif
    </form>
@endsection

@section('javascript')
    <script src="{{ asset('static/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('static/assets/js/messages_zh.js') }}"></script>
    <script>
        $().ready(function() {
            $('#signForm').validate({
                errorPlacement: function(error, element) {
                    $(error).addClass('text-danger');
                    $(element)
                        .closest( "form" )
                        .find('p#'+element.attr('id'))
                        .html(error);
                },
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true
                    },
                    phone: {
                        required: true,
                        minlength:11,
                        maxlength:11
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        minlength: 8,
                        equalTo: '#password'
                    }
                },
                messages: {
                    name: {
                        required: '真实姓名不能为空',
                        minlength: '不能少于两个汉字'
                    },
                    email: {
                        required: '邮箱不能为空'
                    },
                    phone: {
                        required: '手机号不能为空',
                        minlength: '手机号为 11 位',
                        maxlength: '手机号为 11 位'
                    },
                    password: {
                        required: '密码不能为空',
                        minlength: "密码长度不能小于 8"
                    },
                    confirm_password: {
                        required: '确认密码不能为空',
                        minlength: '确认密码长度不能小于 8',
                        equalTo: '两次密码输入不一致'
                    }
                }
            })
        });

        function check() {
            return confirm('请核对身份信息，注册后无法更改！');
        }
    </script>
@endsection

