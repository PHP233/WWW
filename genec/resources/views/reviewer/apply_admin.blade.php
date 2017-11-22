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
    <th> 审议/审批 </th>
    <th> 下载 </th>
@endsection

@section('table_content')
    @foreach($applies as $apply)
        <tr class="odd gradeX">
            <td> {{ \App\utils\Code::getApplyNumber($apply)}} </td>
            <td> {{ $apply->title }} </td>
            <td> {{ $apply->proposer->name }} </td>
            <td> {{ date('Y-m-d',$apply->created_at) }} </td>
            <td> <span class="talbe-span {{ $apply->getStateClass() }}">{{ $apply->state() }}</span> </td>
            <td> {{ $apply->modify_time }} </td>
            <td> <a href="{{ $apply->adviceBtn()['url'] }}">{{ $apply->adviceBtn()['btnName'] }}</a> </td>
            <td><a href="{{ route('apply::download',['id'=>$apply->id,'modify_time'=>$apply->modify_time]) }}">
                    <span class="glyphicon glyphicon-cloud-download"></span>
                </a>
                @if($apply->modify_time > 0)
                    <span>/</span>
                    <button CLASS="btn btn-xs btn-warning" onclick="openUploadHistory({{ $apply->id }},{{ $apply->modify_time }})">上传记录</button>
                @endif
            </td>
        </tr>
    @endforeach
@endsection

@section('table_title','申请表管理')

@section('modal')
    <!-- select checkers modal -->
    @include('common.reviewer.apply_modal')
@stop

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/initDataTable.js') }}"></script>
    <script src="{{ asset('static/assets/js/scripts/review.js') }}"></script>
    <script src="{{ asset('static/assets/js/scripts/time.js') }}"></script>
    <script>
        function ajaxForReviewDetail(id,modify_time) {
            $.ajax({
               url: '{{ route('get_review_list') }}',
               data: {
                   apply_id: id,
                   modify_time: modify_time
               },
                success: function (res) {
                    review_results = res;
                    showReviewDetail(modify_time);
                }
            });
        }

        function ajaxForFail(content) {
            if(!confirm('确定不通过该申请？'))
                return;
            $.get('{{ route('passOrFail') }}',{
                isPass: 0,
                apply_id: temp_documentId,
                m_content: content
            },function (res) {
                var state = $(tr).children('td')[4];
                var btn = $(tr).children('td')[6];
                $(state).html('<span class="talbe-span bg-danger">未通过审批</span>');
                $(btn).html('<a href="javascript:;">-</a>');
                toast(res.msg, review_list_modal);
            })
        }

        function ajaxForPass(content) {
            if(!confirm('确定要通过该申请？'))
                return;
            $.get('{{ route('passOrFail') }}',{
                isPass: 1,
                apply_id: temp_documentId,
                m_content: content
            },function (res) {
                var state = $(tr).children('td')[4];
                var btn = $(tr).children('td')[6];
                $(state).html('<span class="talbe-span bg-success">已批准</span>');
                $(btn).html('<a href="javascript:;">-</a>');
                toast(res.msg, review_list_modal);
            })
        }

        // 发送分配审议任务的请求 different
        function ajaxForAssignReview(checkerIds) {
            $.ajax({
                url: '{{ route('assign') }}',
                type: 'get',
                data: {
                    apply_id: document_id,
                    checker_ids: checkerIds
                },
                success: function (res) {
                    if(res.code) {
                        $('#sign').text(res.msg);
                        var state = $(tr).children('td')[4];
                        var btn = $(tr).children('td')[6];
                        var modify = $(tr).children('td')[5];
                        $(state).html('<span class="talbe-span bg-warning">未审议已分配</span>');
                        $(btn).html('<a href="javascript:reviewList('+ res.reply.id +','+ res.reply.modify_time + ',\''+ res.reply.title +'\');">查看审议情况/审批</a>');
                        toast(res.msg, assignTaskModal);
                    } else {
                        alert(res.msg);
                    }
                },
                error: function (error) {

                }
            });
        }

        /*
        打开上传记录模态框
         */
        function openUploadHistory(apply_id,modify_time) {
            var uploadHistoryModal = $('#upload_history_modal');
            uploadHistoryModal.modal('show');
            var content = '';
            for(var i=0;i<=modify_time;i++) {
                var item = '<div class="col-md-3"><a class="btn btn-default" style="margin-bottom: 5px" ' +
                    'href="{{ url('reviewer/apply/download') }}/'+ apply_id + '/'+ i +'">' +
                '<span class="glyphicon glyphicon-cloud-download"></span>第'+ (i + 1)  +'次上传</a></div>';
                content += item;
            }
            uploadHistoryModal.find('.row').html(content);
        }


    </script>
@endsection