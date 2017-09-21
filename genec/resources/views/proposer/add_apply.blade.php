@extends('proposer.index')
@section('main')
    @include('common.proposer.upload_file')
@endsection
@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/check_upload_file.js') }}"></script>
@endsection
