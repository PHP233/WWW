<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
    @if($reviewer->role)
    <li class="heading">
        <h3 class="uppercase">立项管理</h3>
    </li>
    <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
    <li class="nav-item start">
        <a href="#" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">申请书审批</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item start ">
                <a href="javascript:changeApplyType(0);" class="nav-link ">
                    <i class="icon-bar-chart"></i>
                    <span class="title">全部</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="javascript:changeApplyType(1);" class="nav-link ">
                    <i class="icon-bar-chart"></i>
                    <span class="title">未审议</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="javascript:changeApplyType(2);" class="nav-link ">
                    <i class="icon-bulb"></i>
                    <span class="title">已审议待审批</span>
                    <span class="badge badge-success">1</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="javascript:changeApplyType(3);" class="nav-link ">
                    <i class="icon-graph"></i>
                    <span class="title">未通过审批</span>
                    <span class="badge badge-danger">5</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="javascript:changeApplyType(4);" class="nav-link ">
                    <i class="icon-graph"></i>
                    <span class="title">已批准</span>
                    <span class="badge badge-danger">5</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="{{ route('draft::upload') }}" class="nav-link nav-toggle">
            <i class="icon-briefcase"></i>
            <span class="title">上传送审稿</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
    </li>
    <li class="nav-item start ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">送审稿审批</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item start ">
                <a href="javascript:changeDraftType(0);" class="nav-link ">
                    <i class="icon-bar-chart"></i>
                    <span class="title">全部</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="javascript:changeDraftType(1);" class="nav-link ">
                    <i class="icon-bar-chart"></i>
                    <span class="title">未审议</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="javascript:changeDraftType(2);" class="nav-link ">
                    <i class="icon-bulb"></i>
                    <span class="title">已审议待审批</span>
                    <span class="badge badge-success">1</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="javascript:changeDraftType(3);" class="nav-link ">
                    <i class="icon-graph"></i>
                    <span class="title">未通过审批</span>
                    <span class="badge badge-danger">5</span>
                </a>
            </li>
            <li class="nav-item start ">
                <a href="javascript:changeDraftType(4);" class="nav-link ">
                    <i class="icon-graph"></i>
                    <span class="title">已批准</span>
                    <span class="badge badge-danger">5</span>
                </a>
            </li>

        </ul>
    </li>
    <li class="heading">
        <h3 class="uppercase">人员管理</h3>
    </li>
    <li class="nav-item">
        <a href="javascript:toReviewerAdmin();" class="nav-link nav-toggle">
            <i class="icon-briefcase"></i>
            <span class="title">审议人管理</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
    </li>
    @endif
    @if(!$reviewer->role)
        <li class="heading">
            <h3 class="uppercase">我的审议任务</h3>
        </li>
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
        <li class="nav-item start">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">送审表审议</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start ">
                    <a href="" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">全部</span>
                    </a>
                </li>
                <li class="nav-item start ">
                    <a href="{{ url('reviewer/apply/0') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">未审议</span>
                    </a>
                </li>
                <li class="nav-item start ">
                    <a href="{{ url('reviewer/apply/1') }}" class="nav-link ">
                        <i class="icon-bulb"></i>
                        <span class="title">已审议</span>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item start active open">
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">申请书审议</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item start ">
                    <a href="{{ url('reviewer/apply') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">全部</span>
                    </a>
                </li>
                <li class="nav-item start ">
                    <a href="{{ url('reviewer/apply/0') }}" class="nav-link ">
                        <i class="icon-bar-chart"></i>
                        <span class="title">未审议</span>
                    </a>
                </li>
                <li class="nav-item start ">
                    <a href="{{ url('reviewer/apply/1') }}" class="nav-link ">
                        <i class="icon-bulb"></i>
                        <span class="title">已审议</span>
                        <span class="badge badge-success"></span>
                    </a>
                </li>
            </ul>
        </li>
    @endif
</ul>
