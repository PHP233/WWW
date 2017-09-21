<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../../../wordpress">中国基因行业标准化技术委员会</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{ url('proposer/add_apply') }}">项目申报</a></li>
                <li><a href="#" data-toggle="modal" data-target="#history_apply">历史申报</a></li>
                <li><a href="#contact">意见反馈</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $proposer->name }}，你好 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#self_info">个人信息</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#edit_info">修改个人信息</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header"></li>
                        <li><a href="#" data-toggle="modal" data-target="#find_password">修改密码</a></li>
                        <li><a href="{{ url('proposer/logout') }}">Log out 退出</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>