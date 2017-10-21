<form id="uploadApplyFileForm"  class="form-horizontal" enctype="multipart/form-data" action="@yield('url')" method="post" onsubmit="return check(this)">
    <hr>
    @section('sign')
    <label for="file-zh">
        <span style="font-size: 30px">Step 1</span>&nbsp;&nbsp;&nbsp;提交申请书
    </label>
    @show
    <div class="form-group">
        <label for="apply" class="col-sm-2 control-label">上传文件</label>
        @yield("input")
        <input name="file" type="file" required>
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