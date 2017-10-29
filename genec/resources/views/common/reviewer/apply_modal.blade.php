<div id="assignTaskModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">分配审议人</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>点击要分配的审议人          <small><a class="btn btn-success btn-sm" href="javascript:setAll(1);">全选</a></small></h4>
                        <div id="to_select_list" class="row" style="padding: 15px;border-right:solid 1px;">
                            @foreach($checkers as $checker )
                                <button type="button" class="btn btn-default" data-id="{{ $checker->id }}" title="{{ $checker->sex() }}, 工号：{{ $checker->number }}">{{ $checker->name }}</button>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>点击移除已选择的审议人         <small><a class="btn btn-info btn-sm" href="javascript:setAll();">清空</a></small></h4>
                        <div id="selected_list" class="row" style="padding: 15px">
                            <!-- 填充审议人 -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="assignChecker();">选好了</button>
            </div>
        </div>
    </div>
</div>
<!-- reviewer list -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="review_list_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div id="reviewListBlock" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">审议意见 ——<small></small></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <ul class="list-group">

                        </ul>
                    </div>
                    <div class="col-sm-8">
                        <textarea id="reviewContent" class="form-control" rows="15" readonly></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-6">
                    <div style="float: left;line-height: 57px"><span>修改次数:&nbsp;&nbsp;</span></div>
                    <nav aria-label="Page navigation" style="text-align: left">
                        <ul class="pagination">

                        </ul>
                    </nav>
                </div>
                <button type="button" class="btn btn-default" onclick="turn(1)">审批</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
        <div id="approveBlock" class="modal-content" hidden>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">请根据审议人的意见给出审批结果 ——<small></small></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <textarea id="approve_content" cols="30" rows="10" class="form-control" placeholder="不通过请给出理由和修改意见，通过可以不填写"></textarea><br>
                        <div class="input-group">
                            <button class="btn btn-lg btn-success" aria-label="Left-label" onclick="pass()">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                通过
                            </button>
                            <button class="btn btn-lg btn-danger" aria-label="Left-label" onclick="fail()">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                不通过
                            </button>
                            <span class="text-danger" style="padding-left:50px;"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="turn()">返回审议列表</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="drop_project_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="bg-danger" style="padding: 15px">撤销项目意味着此次项目申报失败，无法再次提交和修改送审表，请慎重选择！
                    <br>请输入登陆密码</p>
                <div class="form-inline">
                    <div class="form-group">
                        <input id="inputPassword" name="inputPassword" type="password" class="form-control" placeholder="登陆密码"/>
                    </div>
                    <button class="btn btn-danger" onclick="ajaxForDropProject()">撤销项目</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- upload history modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="upload_history_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->