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
    <th> 申请人 </th>
    <th> 申请时间 </th>
    <th> 申请状态 </th>
    <th> 修改次数 </th>
    <th> 审议意见 </th>
    <th> 下载 </th>
    <th> 审批 </th>
@endsection

@section('table_content')
    @foreach($applies as $apply)
        <tr class="odd gradeX">
            <td> {{ \App\utils\Code::getApplyNumber($apply)}} </td>
            <td> {{ $apply->title }} </td>
            <td> {{ $apply->proposer->name }} </td>
            <td> {{ $apply->created_at }} </td>
            <td> <span class="talbe-span {{ $apply->getStateClass($apply->state) }}">{{ $apply->state($apply->state) }}</span> </td>
            <td> {{ $apply->modify_time }} </td>
            <td><a href="#">意见</a> </td>
            <td><a href="{{ url('reviewer/apply/download/'.$apply->id) }}">下载</a> </td>
            <td><a href="#" class="btn red btn-xs">审批</a> </td>
        </tr>
    @endforeach
@endsection

@section('table_title','申请表管理')

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/initDataTable.js') }}"></script>
@endsection