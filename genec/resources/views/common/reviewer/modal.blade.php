<!-- Modal reviewer form-->
<div class="modal fade" tabindex="-1" role="dialog" id="add_reviewer_form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">审议人信息        <small id="form_error">手机号，邮箱由审议人自己填写</small></h4>
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
                            <select class="form-control" name="role" id="sex">
                                <option value="{{ \App\utils\Code::male }}">男</option>
                                <option value="{{ \App\utils\Code::female }}">女</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">角色</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="role" id="role">
                                <option value="{{ \App\Model\Reviewer::REVIEWER  }}">审批人</option>
                                <option value="{{ \App\Model\Reviewer::CHECKER }}">审议人</option>
                            </select>
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


<!-- Modal edit reviewer form-->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_reviewer_form">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">审议人信息        <small id="form_error">手机号，邮箱由审议人自己填写</small></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">工号</label>
                        <div class="col-sm-6">
                            <input type="text" id="id" name="id" value="" hidden>
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
                            <select class="form-control" name="sex" id="sex">
                                <option value="1">男</option>
                                <option value="0">女</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-5">
                            <button type="button" class="btn btn-success" onclick="edit()">更新</button>&nbsp;&nbsp;&nbsp;
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
