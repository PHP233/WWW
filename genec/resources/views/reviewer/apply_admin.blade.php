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
        var approve_content;
        var approve_sign;
        $(function() {
            to_select = $('#to_select_list');
            selected = $('#selected_list');
            assignTaskModal = $('#assignTaskModal');
            toast_modal = $('#toast');
            review_list_modal = $('#review_list_modal');
            review_list = review_list_modal.find('ul');
            suggest = review_list_modal.find('textarea#reviewContent');
            approve_content = $('textarea#approve_content');
            approve_sign = review_list_modal.find('span.text-danger');
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
                        $(state).html('<span class="talbe-span bg-warning">未审议已分配</span>');
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

        /*
        打开审议列表，左侧是审议人，右侧是审议内容
         */
        function reviewList(apply_id, name) {
            // 先展示的是审议列表，隐藏审批栏
            $('#approveBlock').hide();
            $('#reviewListBlock').show();
            // 清空上次审批留下的内容
            approve_content.val('');
            approve_sign.text('');
            tr = document.activeElement.parentNode.parentNode;
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
            if(!confirm('确定要通过该申请？'))
                return;
            var content = approve_content.val().trim();
            // 如果通过没有给出理由就填写默认的
            if(content == '') {
                content = '恭喜您，您的申请书通过了审批';
                approve_content.val(content);
            }
            $.get('{{ route('passOrFail') }}',{
                isPass: 1,
                apply_id: temp_applyId,
                m_content: content
            },function (res) {
                var state = $(tr).children('td')[4];
                var btn = $(tr).children('td')[6];
                $(state).html('<span class="talbe-span bg-success">已批准</span>');
                $(btn).html('<a href="javascript:;">-</a>');
                toast(res.msg, review_list_modal);
            })
        }

        // 不通过
        function fail() {
            var content = approve_content.val().trim();
            if(content == '') {
                approve_sign.text('请输入理由和修改意见');
                return;
            }
            if(!confirm('确定不通过该申请？'))
                return;
            $.get('{{ route('passOrFail') }}',{
                isPass: 0,
                apply_id: temp_applyId,
                m_content: content
            },function (res) {
                var state = $(tr).children('td')[4];
                var btn = $(tr).children('td')[6];
                $(state).html('<span class="talbe-span bg-danger">未通过审批</span>');
                $(btn).html('<a href="javascript:;">-</a>');
                toast(res.msg, review_list_modal);
            })
        }

        // 数字转性别
        function sex(sex) {
            if(sex == "1")
                return '男';
            return '女';
        }
    </script>
@endsection