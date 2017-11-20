@extends('common.layout')
@section('title','找回密码')

@section('form_title','中国基因行业标准化<br>技术委员会申报系统密码找回')

@section('css')
    <link href="{{ asset('static/assets/css/signin.css')  }}" rel="stylesheet">
    <style>
        body {
            padding-top: 0;
        }
    </style>
@endsection

@section('form')
    <form id="signForm" class="form-signin" method="post" action="" style="max-width: 600px">
        <h2 class="form-signin-heading">中国基因行业标准化<br>
            技术委员会申报系统<br/><br/>密码找回</h2>
        <br>
        {{ csrf_field() }}
        <input type="number" name="proposer_id" value="{{ $proposer_id }}" hidden>
        <input type="text" name="activeCode" value="{{ $activeCode }}" hidden>
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
            <button class="btn btn-lg btn-primary btn-block" type="submit">提交</button>
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

    </script>
@endsection

