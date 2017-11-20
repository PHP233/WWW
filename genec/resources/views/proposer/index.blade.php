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
            padding: 20px 15px;
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
                @elseif($show_apply->state == \App\Model\Apply::ASSIGN_WAIT_REVIEW)
                    <p class="bg-info proposer_p">您的申请书——{{ $show_apply->title }}正在审议</p>
                @elseif($show_apply->state == \App\Model\Apply::WAIT_PASS)
                    <p class="bg-info proposer_p">您的申请书——{{ $show_apply->title }}已审议完成，等待审批</p>
                @elseif($show_apply->state == \App\Model\Apply::NO_PASS)
                    <p class="bg-danger proposer_p">很抱歉，您的申请书——{{ $show_apply->title }}未通过审批，审批意见如下：</p>
                    <textarea class="form-control" cols="20" rows="15" readonly>
                        {{ \App\Model\Suggest::where('apply_id',$show_apply->id)->where('reviewer_id',$show_apply->reviewer->id)->where('modify_time',$show_apply->modify_time)->first()->content }}
                    </textarea>
                    @include('common.proposer.no_pass_upload')
                @elseif($show_apply->state == \App\Model\Apply::PASS)
                    <p class="bg-success proposer_p">恭喜！您的申请书——{{ $show_apply->title }}已经通过审批，正在为该申请立项</p>
                @elseif($show_apply->state == \App\Model\Apply::DROPPED)
                    <p class="bg-success proposer_p">很抱歉，您的申请书——{{ $show_apply->title }}已被撤销</p>
                @elseif($show_apply->state == \App\Model\Apply::DRAFT_UPLOAD)
                    <p class="bg-success proposer_p">
                        恭喜您，已经为您的申报项目生成了送审表！
                    </p>
                @elseif($show_apply->state == \App\Model\Apply::DRAFT_PASS)
                    <p class="bg-success proposer_p">恭喜您，您的申报项目的送审表已通过审批！</p>
                @elseif($show_apply->state == \App\Model\Apply::PUBLISH)
                    <p class="bg-success proposer_p">恭喜您，您的申报项目已经通过所有流程，正式发表！</p>
                @endif
            @else
                <p class="bg-warning proposer_p">还没有任何项目申报的记录...</p>
            @endif
        @show
    </div>
    <div id="loading" hidden><img src="{{ asset('static/assets/img/loading.gif') }}" alt="loading"></div>
    @include('proposer.apply_list_modal')
    @include('proposer.update_info_modal')
    @include('common.toast')
@endsection


@section('javascript')
    @if(isset($show_apply))
    <script src="{{ asset('static/assets/js/lib.js') }}"></script>
    <script src="{{ asset('static/assets/js/scripts/toast.js') }}"></script>
    <script src="{{ asset('static/assets/js/scripts/check_upload_file.js') }}"></script>
    <script src="{{ asset('static/assets/js/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
            bsStep({{ \App\utils\Code::turnStateToStep($show_apply) }});
            //bsStep(i) i 为number 可定位到第几步 如bsStep(2)/bsStep(3)
        })

        // 设置 ajax 请求加载中动画
        $(document).ajaxStart(function(){
            $.blockUI({
                message: $('#loading'),
                css: {
                    top:  ($(window).height() - 600) /2 + 'px',
                    left: ($(window).width() - 400) /2 + 'px',
                    width: '400px',
                    border: 'none'
                },
                overlayCSS: { backgroundColor: '#fff' }
            });
        }).ajaxStop($.unblockUI);
    </script>
    @endif
@endsection