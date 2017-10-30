@extends('common.admin_layout')

@section('table_title','上传送审表')

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

@section('sign')
    @if(session('sign'))
    {{ session('sign') }}
    @endif
@stop

@section('td')
    <th> 文件编号 </th>
    <th> 申请书题目 </th>
    <th> 申请人 </th>
    <th> 申请时间 </th>
    <th> 对应送审稿 </th>
    <th> 送审稿状态 </th>
    <th> 上传送审稿 </th>
@endsection

@section('table_content')
    @foreach($applies as $apply)
        <tr class="odd gradeX">
            <td> {{ \App\utils\Code::getApplyNumber($apply)}} </td>
            <td> {{ $apply->title }} </td>
            <td> {{ $apply->proposer->name }} </td>
            <td> {{ date('Y-m-d',$apply->created_at) }} </td>
            <td> {{ isset($apply->draft) ? $apply->draft->title : '无'}} </td>
            <td> <span class="talbe-span {{ isset($apply->draft)?$apply->draft->getStateClass():'' }}">{{ isset($apply->draft)?$apply->draft->state():'-' }}</span> </td>
            <td> <a href="javascript:openUploadFormModal({{ $apply->id }},{{isset($apply->draft)}} );"><span class="glyphicon glyphicon-cloud-upload"></span></a> </td>
        </tr>
    @endforeach
@endsection

@section('introduce')
    <div class="row" style="padding:10px;">
        <div id="on_pass_draft_sign"></div>
        <p class="bg-danger" style="padding: 15px">对已经上传送审稿的申请项目，再次上传送审稿将覆盖之前的文件</p>
    </div>
@stop

@section('modal')
    <!-- upload Draft form modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="uploadDraftFormModal" onsubmit="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <span class="modal-title" style="font-size: 18px">上传送审表</span><span class="text-danger" id="error"></span>
                </div>
                <div class="modal-body">
                    <form action="{{ route('draft::upload') }}" class="form-inline" method="post" enctype="multipart/form-data" onsubmit="return check(this)">
                        <div class="form-group">
                            <input id="apply_id" type="number" name="apply_id" value="" hidden>
                            <input type="file" name="file" required/>
                        </div>
                        <button type="submit" class="btn btn-default">上传</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    <script src="{{ asset('static/assets/js/scripts/initDataTable.js') }}"></script>
    <script src="{{ asset('static/assets/js/scripts/check_upload_file.js') }}"></script>
    <script>
        // 打开上传文件的模态框
        function openUploadFormModal(apply_id, has) {
            $('input#apply_id').val(apply_id);
            $('span#error').text('');
            if(has) {
                $('form').attr('onsubmit','return confirm("已上传过送审表，重复上传将覆盖原有的送审表")');
            }
            $('#uploadDraftFormModal').modal('show');
        }
    </script>
@endsection