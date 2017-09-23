<!-- Modal reviewer form-->
<div class="modal fade" tabindex="-1" role="dialog" id="reviewer_form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">审议人信息        <small id="form_error" class="text-danger">手机号，邮箱由审议人自己填写</small></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">工号</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="number" name="number" value="" placeholder="工号" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name" name="name" value="" placeholder="姓名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">性别</label>
                        <div class="col-sm-6">
                            <label class="radio-inline">
                                <input type="radio" name="sex" id="sex1" value="1" required> 男
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sex" id="sex2" value="0" required> 女
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-5">
                            <button type="button" class="btn btn-success" onclick="add()">保存</button>&nbsp;&nbsp;&nbsp;
                            <button type="reset" class="btn btn-success">清空</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->