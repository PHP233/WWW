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
    @include('common.reviewer.apply_modal')
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
        var review_list_modal;
        var review_list;
        var suggest;
        $(function() {
            to_select = $('#to_select_list');
            selected = $('#selected_list');
            assignTaskModal = $('#assignTaskModal');
            toast_modal = $('#toast');
            review_list_modal = $('#review_list_modal');
            review_list = review_list_modal.find('ul');
            suggest = review_list_modal.find('textarea#reviewContent');
            selected.on('click','button', function() {
                this.remove();
                addChecker($(this), 0);
            });

            $('#to_select_list').on('click','button', function() {
                this.remove();
                addChecker($(this), 1);
            });

            Table.order([0,'desc']).draw();
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
                        $(btn).html('<a href="javascript:reviewList('+ apply_id +');">查看审议情况/审批</a>');
                        toast(res.msg, assignTaskModal);
                    } else {
                        alert(msg);
                    }
                },
                error: function (error) {

                }
            });
        }

        var review_arr = [];
        var temp_applyId;

        function reviewList(apply_id, name) {
            review_list_modal.find('small').text(name);
            temp_applyId = apply_id;
            review_arr = [];
            $.get('{{ route('apply::get_review_list') }}',{
                apply_id: apply_id
            }, function (res) {
                var str = '';
                for(var i=0;i<res.length;i++) {
                    review_arr.push(res[i].content);
                    var item = '<button onclick="showContent('+ i +',this)" type="button" class="list-group-item" title="'+ sex(res[i].reviewer.sex) + ',' + res[i].reviewer.number +'">'+ res[i].reviewer.name +'</button>';
                    str += item;
                }
                review_list.html(str);
                showContent(0,review_list.find('button')[0]);
                review_list_modal.modal('show');
            });
        }

        // 切换右侧意见内容
        function showContent(i, btn) {
            review_list.find('button').removeClass('active');
            $(btn).addClass('active');
            if(review_arr[i] == null)
                suggest.val($(btn).text() + '——该审议人还没有审议...');
            else
                suggest.val($(btn).text() + ':  \n' + review_arr[i]);
        }

        // 审议列表 和 审批页面进行切换
        function turn(dir) {
            if(dir) {
                $('#reviewListBlock').hide();
                $('#approveBlock').show();
            } else {
                $('#approveBlock').hide();
                $('#reviewListBlock').show();
            }
        }

        // 审议通过
        function pass() {

        }

        // 不通过
        function fail() {
            if($('textarea#approve_content').val().trim() == "") {
                review_list_modal.find('span.text-danger').text('请输入修改意见');
                return;
            }
        }

        // 数字转性别
        function sex(sex) {
            if(sex == "1")
                return '男';
            return '女';
        }
    </script>
@endsection