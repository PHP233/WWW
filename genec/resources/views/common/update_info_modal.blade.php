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
                        <td id="td_name">{{ $reviewer->name }}</td>
                    </tr>
                    <tr>
                        <th>电话</th>
                        <td id="td_phone">{{ $reviewer->phone }}</td>
                    </tr>
                    <tr>
                        <th>邮箱</th>
                        <td id="td_email">{{ $reviewer->email }}</td>
                    </tr>
                    </tbody>
                </table>
                <form class="form-horizontal" hidden>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" value="{{ $reviewer->name }}" placeholder="姓名" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">电话</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="phone" value="{{ $reviewer->phone }}" placeholder="电话" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" value="{{ $reviewer->email }}" placeholder="邮箱" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-default" onclick="updateInfo()">提交修改</button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button id="turnBack" type="button" class="btn btn-default" onclick="showEditForm()">修改个人信息</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

    var direct = true;

    /*
    显示个人信息
    */
    function showEditForm() {
        if(direct) {
            direct = false;
            $('#self_info_modal .table').hide();
            $('#self_info_modal .form-horizontal').show();
            $('button#turnBack').text('返回');
        } else {
            direct = true;
            $('#self_info_modal .form-horizontal').hide();
            $('#self_info_modal .table').show();
            $('button#turnBack').text('修改个人信息');
        }
    }

    /*
    更新个人信息
     */
    function updateInfo() {
        let name = $('#self_info_modal #name').val();
        let phone = $('#self_info_modal #phone').val();
        let email = $('#self_info_modal #email').val();
        if(name.trim() == '' || phone.trim() == '' || email.trim() == '') {
            alert('姓名电话邮箱不能为空！');
            return;
        }
        if(phone.trim().length != 11) {
            alert('手机号码必须为11位！');
            return;
        }
        if(!checkEmail(email.trim())) {
            alert('邮箱格式不对呦！');
            return;
        }
        $.post('{{ route('updateInfo') }}',{
            'name': name,
            'phone': phone,
            'email': email
        },function (res) {
            toast(res.msg, $('#self_info_modal'));
            $('span.username').text(res.reply.name);
            $('td#td_name').text(res.reply.name);
            $('td#td_phone').text(res.reply.phone);
            $('td#td_email').text(res.reply.email);
        });
    }

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
        $.post('{{ route('changePwd') }}',{
            'pwd0': pwd0,
            'pwd1': pwd1
        }, function (res) {
            if(res.code == 0)
               alert(res.msg);
            else
                location.href = '{{ route('reviewer_login') }}';
        })
    }

    function checkEmail(email) {
        var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        return reg.test(email);
    }
</script>
