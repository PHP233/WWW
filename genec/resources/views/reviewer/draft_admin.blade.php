@extends('common.admin_layout')

@section('css')
    <style>
        .talbe-span {
            padding: 5px
        }
    </style>
@stop

@section('td')
    <th> 文件编号 </th>
    <th> 题目 </th>
    <th> 申请书编号 </th>
    <th> 申请人 </th>
    <th> 申请时间 </th>
    <th> 申请状态 </th>
    <th> 修改次数 </th>
    <th> 审议意见 </th>
    <th> 下载 </th>
    <th> 审批 </th>
@endsection

@section('table_content')
    @foreach($drafts as $draft)
        <tr class="odd gradeX">
            <td> {{ \App\utils\Code::getDraftNumber($draft)}} </td>
            <td> {{ $draft->title }} </td>
            <td> {{ \App\utils\Code::getApplyNumber($draft->apply) }} </td>
            <td> {{ $draft->apply->proposer->name }} </td>
            <td> {{ $draft->created_at }} </td>
            <td> <span class="talbe-span {{ $draft->getStateClass($draft->state) }}">{{ $draft->state($draft->state) }}</span> </td>
            <td> {{ $draft->modify_time }} </td>
            <td><a href="#">意见</a> </td>
            <td><a href="{{ url('reviewer/draft/download/'.$draft->id) }}">下载</a> </td>
            <td><a href="#" class="btn red btn-xs">审批</a> </td>
        </tr>
    @endforeach
@endsection

@section('table_title','送审稿管理')

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/initDataTable.js') }}"></script>
@endsection