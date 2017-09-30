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
            <td> <span class="talbe-span {{ $apply->getStateClass() }}">{{ $apply->state() }}</span> </td>
            <td> {{ $apply->modify_time }} </td>
            <td> <a href="{{ $apply->adviceBtn()['url'] }}">{{ $apply->adviceBtn()['btnName'] }}</a> </td>
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
                                <button type="button" class="btn btn-default" data-id="{{ $checker->id }}" title="{{ $checker->sex() }}, 工号：{{ $checker->number }}">{{ $checker->name }}</button>
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
                    <button type="button" class="btn btn-primary" onclick="assignChecker();">选好了</button>
                </div>
            </div>
        </div>
    </div>
    @include('common.toast')
@stop

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/initDataTable.js') }}"></script>
    <script src="{{ asset('static/assets/js/scripts/toast.js') }}"></script>
    <script>
        var to_select;
        var selected;
        var assignTaskModal;
        var apply_id;
        var apply_title;
        var tr;
        var toast_modal;
        $(function() {
            to_select = $('#to_select_list');
            selected = $('#selected_list');
            assignTaskModal = $('#assignTaskModal');
            toast_modal = $('#toast');
            selected.on('click','button', function() {
                this.remove();
                addChecker($(this), 0);
            });

            $('#to_select_list').on('click','button', function() {
                this.remove();
                addChecker($(this), 1);
            });
        });

        function openAssignTaskModal(id,title) {
            tr = document.activeElement.parentNode.parentNode;
            apply_id = id;
            apply_title = title;
            assignTaskModal.modal('show');
        }

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

        function assignChecker() {
            var buttons = $(selected).find('button');
            var checkers = [];
            var checkerIds = [];
            for(button of buttons) {
                var checker = {};
                checker.id = $(button).data('id');
                checker.name = $(button).text();
                checker.number = $(buttons).attr('title');
                checkers.push(checker);
                checkerIds.push(checker.id);
            }
            var r = confirm('确定要将审议任务分配给——'+ apply_title +'：' + showSelectedCheckerList(checkers));
            if(r) {
                // 发送 ajax 请求，新增审议信息
                ajaxForAssignReview(checkerIds);
            }
        }

        function showSelectedCheckerList(checkers) {
            var str = '\r\n';
            for(checker of checkers) {
                str += checker.number + ', ' + checker.name + '\r\n';
            }
            return str;
        }

        function ajaxForAssignReview(checkerIds) {
            $.ajax({
                url: '{{ route('assign') }}',
                type: 'get',
                data: {
                    apply_id: apply_id,
                    checker_ids: checkerIds
                },
                success: function (res) {
                    if(res.code) {
                        $('#sign').text(res.msg);
                        var state = $(tr).children('td')[4];
                        var btn = $(tr).children('td')[6];
                        $(state).html('<span class="talbe-span bg-warning">未审议已分配审议任务</span>');
                        $(btn).html('<a href="#">等待审议人审议</a>');
                        toast(toast_modal, res.msg);
                        //setTimeout("toast_modal.modal('hide')",2000);
                    } else {
                        alert(msg);
                    }
                    assignTaskModal.modal('hide');
                },
                error: function (error) {

                }
            });
        }

        function getCheckerIds(checkers) {

        }
    </script>
@endsection