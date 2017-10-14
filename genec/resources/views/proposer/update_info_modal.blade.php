<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="self_info_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">个人信息</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>姓名</th>
                        <td id="td_name">{{ $proposer->name }}</td>
                    </tr>
                    <tr>
                        <th>电话</th>
                        <td id="td_phone">{{ $proposer->phone }}</td>
                    </tr>
                    <tr>
                        <th>邮箱</th>
                        <td>{{ $proposer->email }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- findPassword modal -->
<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="changePwd_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">修改密码</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="pwd0" class="col-sm-2 control-label">原密码</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="pwd0" placeholder="原密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pwd1" class="col-sm-2 control-label">新密码</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="pwd1" placeholder="新密码">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pwd2" class="col-sm-2 control-label">确认新密码</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="pwd2" placeholder="确认密码">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="changePwd()">修改</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    /*
        更改密码
    */
    function changePwd() {
        let pwd0 = $('#pwd0').val();
        let pwd1 = $('#pwd1').val();
        let pwd2 = $('#pwd2').val();
        if(pwd0.trim() == '' || pwd1.trim() == '' || pwd2.trim() == '') {
            alert('密码不能为空！');
            return;
        }
        if(pwd1.length < 8) {
            alert('新密码长度不能少于8位！');
            return;
        }
        if(pwd1 != pwd2) {
            alert('新密码两次输入不一致！');
            return;
        }
        $.post('{{ route('proposer_changePwd') }}',{
            'pwd0': pwd0,
            'pwd1': pwd1
        }, function (res) {
            if(res.code == 0)
                alert(res.msg);
            else
                location.href = '{{ route('proposer_login') }}';
        })
    }
</script>