<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="history_apply">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <table class="table table-hover">
                    <caption>历史申报列表</caption>
                    <thead>
                    <tr>
                        <th>题目</th>
                        <th>状态</th>
                        <th>修改次数</th>
                        <th>申报时间</th>
                    </tr>
                    <tbody>
                    @foreach($applies as $apply)
                    <tr>
                        <td><a href="{{ url('proposer/'.$apply->id) }}">{{ $apply->title }}</a></td>
                        <td>{{ $apply->state($apply->state) }}</td>
                        <td>{{ $apply->modify_time }}</td>
                        <td>{{ $apply->created_at }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="self_info">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">个人信息</h4>
            </div>
            <div class="modal-body">
                <p class="bg-info">{{ $proposer->name }}</p>
                <p class="bg-primary">{{ $proposer->email }}</p>
                <p class="bg-success">{{ $proposer->phone }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" >修改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal self_info-->
<div class="modal fade" tabindex="-1" role="dialog" id="edit_info">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">个人信息</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-6">
                            <input type="name" class="form-control" id="name" value="{{ $proposer->name }}" placeholder="姓名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">电话</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="phone" value="{{ $proposer->phone }}" placeholder="手机号码">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">保存</button>
                <button type="button" class="btn btn-info" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- findPassword modal -->