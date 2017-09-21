@extends('common.layout')
<?php
$applies = session('applies');
$proposer = session('proposer');
?>
@section('css')
    <link rel="stylesheet" href="{{ asset('static/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/assets/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('static/assets/css/process_style.css') }}">
@endsection

@section('body')
    <!-- Fixed navbar -->
    @include('common.proposer.head')
    <div class="container theme-showcase" role="main">
        @include('common.proposer.guide')
        @section('main')
            @if(isset($show_apply))
                @if($show_apply->state === 0)
                    @include('common.proposer.re_upload_file')
                @endif
            @endif
        @show
    </div>
    @include('proposer.modal')
@endsection


@section('javascript')
    @if(isset($show_apply))
    <script>
        $(function() {
            bsStep({{$show_apply->state + 2}});
            //bsStep(i) i 为number 可定位到第几步 如bsStep(2)/bsStep(3)
        })
    </script>
    @endif
@endsection