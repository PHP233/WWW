@extends('common.proposer.upload_file')

@section('question')
    && confirm('重复上传将会覆盖之前上传的文件！')
@endsection

@section('url')
    {{ route('reUploadApply') }}
@endsection

@section('sign')
    <p class="bg-success" style="padding: 15px">
        你已经上传了申请书，请等待组委会评审，在评审前可以重新上传覆盖之前的文件
    </p>
@endsection

@section('form_title','申请书题目')

@section('input')
    <input name="id" value="{{ $show_apply->id }}" hidden/>
@stop