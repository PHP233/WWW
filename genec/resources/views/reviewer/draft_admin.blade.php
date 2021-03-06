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
    <th> 申请书题目 </th>
    <th> 申请人 </th>
    <th> 申请时间 </th>
    <th> 申请状态 </th>
    <th> 修改次数 </th>
    <th> 审议/审批 </th>
    <th> 下载 </th>
@endsection

@section('table_content')
    @foreach($drafts as $draft)
        <tr class="odd gradeX">
            <td> {{ \App\utils\Code::getDraftNumber($draft)}} </td>
            <td> {{ $draft->title }} </td>
            <td> {{ $draft->apply->title }} </td>
            <td> {{ $draft->apply->proposer->name }} </td>
            <td> {{ date('Y-m-d',$draft->created_at) }} </td>
            <td> <span class="talbe-span {{ $draft->getStateClass($draft->state) }}">{{ $draft->state($draft->state) }}</span> </td>
            <td> {{ $draft->modify_time }} </td>
            <td> <a href="{{ $draft->adviceBtn()['url'] }}">{{ $draft->adviceBtn()['btnName'] }}</a> </td>
            <td>
                <a href="{{ route('draft::download',['id'=>$draft->id,'modify_time'=>$draft->modify_time]) }}"><span class="glyphicon glyphicon-cloud-download"></span></a>
                @if($draft->modify_time)
                    <span>/</span>
                    <button class="btn btn-xs btn-warning" onclick="showHistoryDraft({{$draft->id}},{{$draft->modify_time}})">历史上传</button>
                @endif
            </td>
        </tr>
    @endforeach
@endsection

@section('table_title','送审稿管理')

@section('modal')
    <!-- select checkers modal -->
    @include('common.reviewer.apply_modal')
@stop

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/initDataTable.js') }}"></script>
    <script src="{{ asset('static/assets/js/scripts/review.js') }}"></script>
    <script>
        function ajaxForReviewDetail(id,modify_time) {
            $.ajax({
                url: '{{ route('get_review_list') }}',
                data: {
                    draft_id: id,
                    modify_time: modify_time
                },
                success: function (res) {
                    review_results = res;
                    // 显示所有审议结果
                    showReviewDetail(modify_time);
                }
            });
        }

        function ajaxForFail(content) {
            if(!confirm('确定不通过该送审稿？'))
                return;
            $.get('{{ route('passOrFail') }}',{
                isPass: 0,
                draft_id: temp_documentId,
                m_content: content
            },function (res) {
                var state = $(tr).children('td')[5];
                var btn = $(tr).children('td')[7];
                $(state).html('<span class="talbe-span bg-danger">未通过审批</span>');
                $(btn).html('<a href="javascript:dropProject('+res.reply.id+');">撤销项目</a>');
                toast(res.msg, review_list_modal);
            })
        }

        function ajaxForPass(content) {
            if(!confirm('确定要通过该送审表？'))
                return;
            $.get('{{ route('passOrFail') }}',{
                isPass: 1,
                draft_id: temp_documentId,
                m_content: content
            },function (res) {
                var state = $(tr).children('td')[5];
                var btn = $(tr).children('td')[7];
                $(state).html('<span class="talbe-span bg-success">已批准</span>');
                $(btn).html('<a href="javascript:publish(' + temp_documentId + ');">出版</a>');
                toast(res.msg, review_list_modal);
            })
        }

        // 发送分配审议任务的请求 different
        function ajaxForAssignReview(checkerIds) {
            $.ajax({
                url: '{{ route('assign') }}',
                type: 'get',
                data: {
                    draft_id: document_id,
                    checker_ids: checkerIds
                },
                success: function (res) {
                    if(res.code) {
                        $('#sign').text(res.msg);
                        var state = $(tr).children('td')[5];
                        var btn = $(tr).children('td')[7];
                        $(state).html('<span class="talbe-span bg-warning">未审议已分配</span>');
                        $(btn).html('<a href="javascript:reviewList('+ res.reply.id +','+ res.reply.modify_time + ',\''+ res.reply.title +'\');">查看审议情况/审批</a>');
                        toast(res.msg, assignTaskModal);
                    } else {
                        alert(msg);
                    }
                },
                error: function (error) {

                }
            });
        }

        /*
        出版
         */
        function publish(id) {
            tr = document.activeElement.parentNode.parentNode;
            if(!confirm('确定要出版此项目？')) {
                return;
            }
            $.get('{{ route('publish') }}',{
                'id': id
            },function (res) {
                toast(res.msg);
                var state = $(tr).children('td')[5];
                var btn = $(tr).children('td')[7];
                $(state).html('<span class="talbe-span bg-default">已出版</span>');
                $(btn).html('<a href="javascript:#;">-</a>');
            })
        }

        /*
        撤销项目
         */
        var temp_id;
        function dropProject(id) {
            temp_id = id;
            tr = document.activeElement.parentNode.parentNode;
            $('#drop_project_modal').modal('show');
        }

        function ajaxForDropProject() {
            var password = $('#drop_project_modal #inputPassword').val();
            if(password.trim() == '') {
                toast('密码不能为空！');
                return;
            }
            $.get('{{ route('dropProject') }}',{
                'id': temp_id,
                'password': password
            },function (res) {
                toast(res.msg, $('#drop_project_modal'));
                if(res.code) {  // 撤销成功
                    var state = $(tr).children('td')[5];
                    var btn = $(tr).children('td')[7];
                    $(state).html('<span class="talbe-span bg-default">已撤销</span>');
                    $(btn).html('<a href="javascript:#;">-</a>');
                }
            })
        }

        /*
        显示历史上传送审表的模态框
         */
        function showHistoryDraft(apply_id, modify_time) {
            var uploadHistoryModal = $('#upload_history_modal');
            uploadHistoryModal.modal('show');
            var content = '';
            for(var i=0;i<=modify_time;i++) {
                var item = '<div class="col-md-3"><a class="btn btn-default" style="margin-bottom: 5px" ' +
                    'href="{{ url('reviewer/draft/download') }}/'+ apply_id + '/'+ i +'">' +
                    '<span class="glyphicon glyphicon-cloud-download"></span>第'+ (i+1) +'次上传</a></div>';
                content += item;
            }
            uploadHistoryModal.find('.row').html(content);
        }
    </script>
@endsection