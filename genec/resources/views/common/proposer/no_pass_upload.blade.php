@extends('common.proposer.upload_file')

@section('url')
    {{ route('no_passUpload') }}
@endsection

@section('form_title','申请书题目')

@section('sign')
    <p class="bg-warning" style="padding: 15px">
        重新上传申请书
    </p>
@stop

@section('file_title')
{{ \App\utils\Code::removeExt($show_apply->title) }}
@stop

@section('input')
    <input name="id" value="{{ $show_apply->id }}" readonly hidden/>
@stop