@extends('common.admin_layout')

@section('table_title','上传送审表')

@section('sign')
    @if(session('sign'))
    {{ session('sign') }}
    @endif
@stop

@section('table_content')
    <form id="uploadDraftForm"  class="form-horizontal" enctype="multipart/form-data" action="" method="post" onsubmit="return check(this)">
        <div class="form-group row">
            <label for="apply_list" class="col-sm-2 control-label">选择已通过审批的申请</label>
            <div class="col-sm-5">
                <select class="form-control" id="apply_list" name="apply_id" onchange="ajaxIsHasDraft();">
                @foreach($applies as $apply)
                    <option value="{{ $apply->id }}">{{ $apply->id }}号申请书：{{ $apply->title }}</option>
                @endforeach
                </select>
            </div>
            <div class="col-sm-5">
                <p id="isHasUploadDraft" class="text-danger"></p>
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-sm-2 control-label">请输入送审表题目</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="title" name="title" placeholder="送审表题目" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="apply" class="col-sm-2 control-label">上传文件</label>
            <input id="draft" name="draft" type="file" required>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">提交</button>
                <button type="reset" class="btn btn-info">清空</button>
            </div>
        </div>
        <hr>
    </form>
    <div style="padding-top: 10px">
        <p id="error" class="bg-danger"></p>
    </div>
@endsection

@section('introduce')
    <div class="row" style="padding:10px;">
        <div id="on_pass_draft_sign"></div>
        <p class="bg-warning" style="padding: 15px">请先选择一个申请，对已经上传送审稿的申请项目，再次上传送审稿将覆盖之前的文件</p>
    </div>
@stop

@section('javascript')
    <script>

        var isHasDraft;
        var sure;
        $(function () {
            isHasDraft = $('#isHasUploadDraft');
            ajaxIsHasDraft();
        });

        function ajaxIsHasDraft() {
            $.get('{{ route('draft::isHasDraft') }}',{
                'apply_id': $('#apply_list').val()
            },function (res) {
                sure = res.code;
                isHasDraft.text(res.msg);
                var sign = $('div#on_pass_draft_sign');
                sign.html('');
                if(!sure)
                    return;
                if(res.reply.state == 3) {
                    var str = '<p class="bg-danger" style="padding: 15px">'+ res.reply.id + ' 号送审表 ' + res.reply.title + '未通过审批，请重新上传送审表,并分配审议人审议' +
                        '<br/>未通过意见：'+ res.reply.suggest +'</p>';
                    sign.html(str);
                }
            })
        }

        function check(form) {
            var error = $('#error');
            var draft = getFileName(form.draft.value);
            console.log(draft);
            console.log(draft[draft.length - 1]);
            if(draft[1] != 'doc' && draft[1] != 'docx') {
                error.css('padding','15px');
                error.html('上传的文件必须是doc或docx类型');
                return false;
            }
            if(form.title.value != draft[0]) {
                error.css('padding','15px');
                error.html('题目要与上传文件名一致');
                return false;
            }
            if(sure && !confirm('再次上传该送审表将覆盖之前的文件，是否继续？'))
                return false;
            return true;
        }

        function getFileName(file) {
            var fileNamePos = file.lastIndexOf('\\');
            var extPos = file.lastIndexOf('.');
            console.log(fileNamePos);
            console.log(extPos);
            var pos = [file.substring(fileNamePos + 1, extPos), file.substring(extPos + 1)];
            return pos;
        }

    </script>
@endsection