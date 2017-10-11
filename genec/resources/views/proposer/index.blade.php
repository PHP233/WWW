@extends('common.layout')
<?php
$applies = session('applies');
$proposer = session('proposer');
?>
@section('css')
    <link rel="stylesheet" href="{{ asset('static/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/assets/css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('static/assets/css/process_style.css') }}">
    <style>
        .proposer_p {
            padding: 50px 15px;
            font-size: 20px;
        }
    </style>
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
                @elseif($show_apply->state == 1)
                    <p class="bg-success proposer_p">您的申请书——{{ $show_apply->title }}正在审议</p>
                @elseif($show_apply->state == 2)
                    <p class="bg-success proposer_p">您的申请书——{{ $show_apply->title }}已审议完成，等待审批</p>
                @elseif($show_apply->state == 3)
                    <p class="bg-success proposer_p">很抱歉，您的申请书——{{ $show_apply->title }}未通过审批，审批意见如下：
                    {{ \App\Model\Suggest::where('apply_id',$show_apply->id)->where('reviewer_id',$admin_id)->where('modify_time',$show_apply->modify_time)->first()->content }}
                    </p>

                @elseif($show_apply->state == 4)
                    <p class="bg-success proposer_p">恭喜！您的申请书——{{ $show_apply->title }}已经通过审批，正在为该申请立项</p>
                @elseif($show_apply->state == 5)
                    <p class="bg-success proposer_p">该申请书——{{ $show_apply->title }}已被撤销</p>
                @endif
            @else
                <p class="bg-warning proposer_p">还没有任何项目申报的记录...</p>
            @endif
        @show
    </div>
    @include('proposer.modal')
@endsection


@section('javascript')
    @if(isset($show_apply))
    <script src="{{ asset('static/assets/js/lib.js') }}"></script>
    <script>
        $(function() {
            bsStep({{ \App\utils\Code::turnStateToStep($show_apply) }});
            //bsStep(i) i 为number 可定位到第几步 如bsStep(2)/bsStep(3)
        })
    </script>
    @endif
@endsection