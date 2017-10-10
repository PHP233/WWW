<form id="uploadApplyFileForm"  class="form-horizontal" enctype="multipart/form-data" action="{{ route('proposer_add_apply') }}" method="post" onsubmit="return check(this)">
    <hr>
    <p class="bg-success" style="padding: 15px">你已经上传了申请书，请等待组委会评审，在评审前可以重新上传覆盖之前的文件</p>
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">请输入申请书题目</label>
        <div class="col-sm-5">
            <input type="number" id="id" name="id" value="{{ $show_apply->id }}" hidden>
            <input type="text" id="kind" name="kind" value="1" hidden><!-- 说明是覆盖上传 -->
            <input type="text" class="form-control" id="title" name="title" value="{{ $show_apply->title }}" placeholder="申请书题目" required>
        </div>
    </div>
    <div class="form-group">
        <label for="apply" class="col-sm-2 control-label">上传文件</label>
        <input id="apply" name="apply" type="file" required>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">提交</button>
            <button type="reset" class="btn btn-info">清空</button>
        </div>
    </div>
    <hr>
</form>
<p id="error" class="bg-danger"></p>