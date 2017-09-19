<div class="container theme-showcase" role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron" style="padding-top: 20px;padding-bottom: 20px">
        <div class="row">
            <div class="col-md-4 col-xs-12"><h2>标准申报流程</h2></div>
            @if(isset($show_apply))
                <div class="col-md-8 col-xs-12"><h3>当前申报: {{ $show_apply->title }}</h3></div>
            @endif
        </div>
        <ul class="nav nav-pills nav-justified step step-arrow">
            <li class="active">
                <a href="javascript:uploadFile()">提交申请</a>
            </li>
            <li>
                <a>审议批准</a>
            </li>
            <li>
                <a>立项</a>
            </li>
            <li>
                <a>&nbsp;&nbsp;&nbsp;提交送审稿</a>
            </li>
            <li>
                <a>审查</a>
            </li>
            <li>
                <a>出版</a>
            </li>
        </ul>
    </div>
</div>