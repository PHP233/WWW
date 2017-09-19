@extends('common.layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('static/assets/css/process_style.css') }}">
    <link href="{{ asset('static/assets/css/file_input.min.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../../wordpress">中国女医师协会</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">项目申报</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#history_apply">历史申报</a></li>
                    <li><a href="#contact">意见反馈</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ session('proposer.name') }}，你好 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#self_info">个人信息</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#edit_info">修改个人信息</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header"></li>
                            <li><a href="#" data-toggle="modal" data-target="#find_password">修改密码</a></li>
                            <li><a href="{{ url('proposer/logout') }}">Log out 退出</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container theme-showcase" role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron" style="padding-top: 20px;padding-bottom: 20px">
            <h2>标准申报流程</h2><span>您的最近一次申报情况</span>
            <ul class="nav nav-pills nav-justified step step-arrow">
                <li class="active">
                    <a href="javascript:uploadFile()">提交申请</a>
                </li>
                <li>
                    <a>审议批准</a>
                </li>
                <li>
                    <a>立项</a>
                </li>
                <li>
                    <a>&nbsp;&nbsp;&nbsp;提交送审稿</a>
                </li>
                <li>
                    <a>审查</a>
                </li>
                <li>
                    <a>出版</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('static/assets/js/lib.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/assets/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('static/assets/js/zh.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            bsStep({{session('applies')[0]->state + 2}});
            //bsStep(i) i 为number 可定位到第几步 如bsStep(2)/bsStep(3)
        })
        $('#file-zh').fileinput({
            language: 'zh',
            uploadUrl: '#',
            allowedFileExtensions : ['doc','docx']
        });
    </script>
@endsection