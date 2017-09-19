@extends('common.layout')
<?php
$applies = session('applies');
$proposer = session('proposer');
$last_apply = $applies->first();
?>
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('static/assets/css/process_style.css') }}">
    <link href="{{ asset('static/assets/css/file_input.min.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <!-- Fixed navbar -->
    @include('common.proposer.head')

    <div class="container theme-showcase" role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron" style="padding-top: 20px;padding-bottom: 20px">
            <div class="row">
                <div class="col-md-4 col-xs-12"><h2>标准申报流程</h2></div>
                <div class="col-md-8 col-xs-12"><h3>您的最近一次申报情况: {{ $last_apply->title }}</h3></div>
            </div>
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
@include('proposer.modal')

@section('javascript')
    <script type="text/javascript" src="{{ asset('static/assets/js/lib.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/assets/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('static/assets/js/zh.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            bsStep({{$last_apply->state + 2}});
            //bsStep(i) i 为number 可定位到第几步 如bsStep(2)/bsStep(3)
        })
        $('#file-zh').fileinput({
            language: 'zh',
            uploadUrl: '#',
            allowedFileExtensions : ['doc','docx']
        });
    </script>
@endsection