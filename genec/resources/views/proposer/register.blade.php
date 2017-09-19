@extends('common.layout')
@section('title','中国基因行业标准化技术委员会申报系统')

@section('form_title','中国基因行业标准化<br>技术委员会申报系统')

@section('form')
    <form id="signForm" class="form-signin" method="post" action="" style="max-width: 800px;width: 600px;padding-left: 10px;margin-left: 30%;">
        <h2 class="form-signin-heading">申报系统申报人注册</h2>
        <br>
        {{ csrf_field() }}
        <label for="inputName">真实姓名</label>
        <div class="row">
            <div class="col-md-8">
                <input type="text" id="inputName" name="name" class="form-control" placeholder="真实姓名" autofocus>
            </div>
            <div class="col-md-4"><p id="inputName"></p></div>
        </div>
        <label for="inputEmail">邮箱</label>
        <div class="row">
            <div class="col-md-8">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="邮箱" autofocus>
            </div>
            <div class="col-md-4"><p id="inputEmail"></p></div>
        </div>
        <label for="inputPhone">手机号</label>
        <div class="row">
            <div class="col-md-8">
                <input type="text" id="inputPhone" name="phone" class="form-control" placeholder="手机号" autofocus>
            </div>
            <div class="col-md-4">
                <p id="inputPhone"></p>
            </div>
        </div>
        <label for="inputPassword">密码</label>
        <div class="row">
            <div class="col-md-8">
                <input type="password" id="password" name='password' class="form-control" placeholder="密码">
            </div>
            <div class="col-md-4">
                <p id="inputPassword"></p>
            </div>
        </div>
        <label for="inputConfirmPassword">确认密码</label>
        <div class="row">
            <div class="col-md-8">
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="确认密码">
            </div>
            <div class="col-md-4">
                <p id="inputConfirmPassword"></p>
            </div>
        </div>
        <div class="col-md-8">
            <button class="btn btn-lg btn-primary btn-block" type="submit">注册</button></div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6">
                <a class="btn btn-link" href="{{ route('proposer_login') }}">已有账号点击登录</a>
            </div>
        </div>
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
                        //.find("label[id='" + element.attr( "id" ) + "']" )
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
        })
    </script>
@endsection

