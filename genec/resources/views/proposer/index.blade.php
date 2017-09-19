@extends('common.layout')
<?php
$applies = session('applies');
$proposer = session('proposer');
?>
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('static/assets/css/process_style.css') }}">
    <link href="{{ asset('static/assets/css/file_input.min.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <!-- Fixed navbar -->
    @include('common.proposer.head')
    @include('common.proposer.guide')

@endsection
@include('proposer.modal')

@section('javascript')
    <script type="text/javascript" src="{{ asset('static/assets/js/lib.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/assets/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('static/assets/js/zh.js') }}" type="text/javascript"></script>
    <script>
        @if(isset($show_apply))
        $(function() {
            bsStep({{$show_apply->state + 2}});
            //bsStep(i) i 为number 可定位到第几步 如bsStep(2)/bsStep(3)
        })
        @endif
        $('#file-zh').fileinput({
            language: 'zh',
            uploadUrl: '#',
            allowedFileExtensions : ['doc','docx']
        });
    </script>
@endsection