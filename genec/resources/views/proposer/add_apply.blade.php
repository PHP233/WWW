@extends('proposer.index')
@section('main')
    @include('common.proposer.upload_file')
@endsection
@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/check_upload_file.js') }}"></script>
    <script>
        // 控制导航栏链接高亮
        $('ul.nav').children('li').eq(0).addClass('active');
    </script>
@endsection
