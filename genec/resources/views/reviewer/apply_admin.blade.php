@extends('common.admin_layout')

@section('css')
    <style>
        .talbe-span {
            padding: 5px
        }
        modal-body button {
            margin: 10px 5px;
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
            <td> <a href="{{ $apply->adviceBtn($apply->state)['url'] }}">{{ $apply->adviceBtn($apply->state)['btnName'] }}</a> </td>
            <td><a href="{{ url('reviewer/apply/download/'.$apply->id) }}">下载</a> </td>
        </tr>
    @endforeach
@endsection

@section('table_title','申请表管理')

@section('modal')
    <!-- select checkers modal -->
    <div id="assignTaskModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">分配审议人</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>点击要分配的审议人          <small><a class="btn btn-success btn-sm" href="javascript:setAll(1);">全选</a></small></h4>
                            <div id="to_select_list" class="row" style="padding: 15px;border-right:solid 1px;">
                                @foreach($checkers as $checker )
                                <button type="button" class="btn btn-default" data-id="{{ $checker->id }}" title="{{ $checker->sex($checker->sex) }}, 工号：{{ $checker->number }}">{{ $checker->name }}</button>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>点击移除已选择的审议人         <small><a class="btn btn-info btn-sm" href="javascript:setAll();">清空</a></small></h4>
                            <div id="selected_list" class="row" style="padding: 15px">
                                <!-- 填充审议人 -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary">选好了</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/initDataTable.js') }}"></script>
    <script>
        var to_select;
        var selected;
        $(function() {
            to_select = $('#to_select_list');
            selected = $('#selected_list');

            selected.on('click','button', function() {
                this.remove();
                addChecker($(this), 0);
            });

            $('#to_select_list').on('click','button', function() {
                this.remove();
                addChecker($(this), 1);
            });
        });

        function openAssignTaskModal() {
            $('#assignTaskModal').modal('show');
        }

        function openModal() {
            $('#assignTaskModal').modal('show');
        };

        function addChecker(item, direction) {
            var id = item.data('id');
            var name = item.text();
            var title = item.attr('title');
            var button = '<button type="button" class="btn btn-default" data-id="'+id+'" title="'+ title +'">'+name+'</button>';
            if(direction) {
                $(selected).prepend(button);
            } else {
                $(to_select).prepend(button);
            }
        }

        function setAll(type) {
            if(type) {
                var buttons = $(to_select).find('button');
            } else {
                buttons = $(selected).find('button');
            }
            for(button of buttons) {
                button.remove();
                addChecker($(button), type);
            }
        }
    </script>
@endsection