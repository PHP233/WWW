@extends('common.admin_layout')

@section('css')
    <style>
        .talbe-span {
            padding: 5px
        }
        .modal-body button {
            margin: 2px 1px;
        }
    </style>
@stop

@section('td')
    <th> 申请书编号 </th>
    <th> 题目 </th>
    <th> 申请人 </th>
    <th> 申请时间 </th>
    <th> 分配状态 </th>
    <th> 审批负责人 </th>
    <th> 送审稿 </th>
    <th> 项目状态 </th>
@endsection

@section('table_content')
    @foreach($applies as $apply)
        <tr class="odd gradeX">
            <td> {{ \App\utils\Code::getApplyNumber($apply)}} </td>
            <td> {{ $apply->title }} </td>
            <td> {{ $apply->proposer->name }} </td>
            <td> {{ date('Y-m-d',$apply->created_at) }} </td>
            <td> {{ $apply->reviewer ? '已分配': '未分配'}} </td>
            <td>
                @if($apply->reviewer)
                    {{ $apply->reviewer->name }}
                @else
                    <button class="btn btn-danger btn-xs" onclick="openAssignModal({{$apply->id}},this)">分配审批</button>
                @endif
            </td>
            <td> {{ $apply->draft ? $apply->draft->title : '-' }} </td>
            <td> <span class="talbe-span {{ $apply->getStateClass() }}">{{ $apply->state() }}</span> </td>
        </tr>
    @endforeach
@endsection

@section('table_title','项目分配')

@section('modal')
    <!-- select checkers modal -->
    @include('admin.assign_modal')
@stop

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/initDataTable.js') }}"></script>
    <script src="{{ asset('static/assets/js/scripts/time.js') }}"></script>
    <script>

        let assignModal;

        $(function () {
            assignModal = $('#assignModal');
            Table.column(0).visible(true);
            Table.column(4).visible(false);
        });

        let apply_id;
        let tr;

        //打开分配审批负责人的模态框
        function openAssignModal(id,it) {
            apply_id = id;
            tr = it;
           assignModal.modal('show');
        }

        function assign(reviewer_id,name) {
            if(!confirm('确定要将该项目交给审批人：' + name + ' 负责？'))
                return;
            $.get('{{ route('admin::assign') }}',{
                'apply_id': apply_id,
                'reviewer_id': reviewer_id
            },function (res) {
                if(res.code) {
                    $(tr).parent().text(name);
                    toast(res.msg, assignModal);
                }
            })
        }
    </script>
@endsection