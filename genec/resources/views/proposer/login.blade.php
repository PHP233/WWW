@extends('common.layout')
@section('send_email_url')
    {{ route('proposer_resetPassword') }}
@endsection
@section('title','中国基因行业标准化技术委员会申报系统')

@section('form_title','中国基因行业标准化<br>技术委员会申报系统')

@section('register')
    <a class="btn btn-link" href="{{ route('proposer_register') }}">申请人注册</a>
@endsection

@section('login_name')
    <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="邮箱" required autofocus>
@endsection

@section('css')
    <link href="{{ asset('static/assets/css/signin.css')  }}" rel="stylesheet">
@endsection