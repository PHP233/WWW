<?php
    $reviewer = session()->get('reviewer');
?>
<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('static/assets/css/plugins/googlefont.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/assets/css/plugins/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/assets/css/plugins/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/assets/css/plugins/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/dist/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/assets/css/plugins/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/assets/css/plugins/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('static/assets/css/plugins/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/assets/css/plugins/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('static/assets/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('static/assets/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('static/assets/css/layout/layout.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('static/assets/css/layout/darkblue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('static/assets/css/layout/custom.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
                <img src="{{ asset('static/assets/img/logo.gif') }}" alt="logo" class="logo-default" />
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile"> {{ $reviewer == null? '' : $reviewer->name }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#self_info_modal">
                                <i class="icon-user"></i> 个人信息 </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#changePwd_modal">
                                <i class="icon-lock"></i> 修改密码 </a>
                        </li>
                        <li>
                            <a href="{{ route('reviewer_logout') }}">
                                <i class="icon-key"></i> 退出 </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            @include('common.reviewer.page-sidebar')
            <!-- END SIDEBAR MENU -->
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title">
                {{--Managed Datatables
                <small>managed datatable samples</small>--}}
                @yield('page-title')
            </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">@yield('table_title')</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span id="sign" class="text-success">@yield('sign')</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            @yield('add_button_name')
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="data_table">
                                <thead>
                                <tr>
                                    @yield('td')
                                </tr>
                                </thead>
                                <tbody>
                                @section('table_content')
                                <tr class="odd gradeX">
                                    {{-- ajax 填充 --}}
                                </tr>
                                @show
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            @yield('introduce')
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <a href="javascript:;" class="page-quick-sidebar-toggler">
        <i class="icon-login"></i>
    </a>
    <!-- END QUICK SIDEBAR -->
</div>
@yield('modal')
@include('common.toast')
@include('common.update_info_modal')
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div id="loading" hidden><img src="{{ asset('static/assets/img/loading.gif') }}" alt="loading"></div>
<div class="page-footer">
    <div class="page-footer-inner"> 中国基因行业标准技术委员会
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
<!--[if lt IE 9]>
<scripts src="{{ asset('static/assets/plugins/respond.min.js')}}"></scripts>
<scripts src="{{ asset('static/assets/plugins/excanvas.min.js')}}"></scripts>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('static/assets/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/plugins/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/plugins/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/plugins/jquery.uniform.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/plugins/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('static/assets/js/plugins/datatables.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/plugins/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/plugins/datatables.bootstrap.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('static/assets/js/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('static/assets/js/scripts/table-datatables-managed.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('static/assets/js/scripts/layout.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/scripts/demo.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('static/assets/js/scripts/toast.js') }}"></script>
@yield('javascript')
<script>
    /*
    dataTable 搜索栏关键字，点击按钮进行关键字的搜索
     */
    const typeArr = ['','未审议','已审议','未通过审批','已批准','未分配','已分配','审批人','审议人','项目完成','已撤销'];
    const url_arr = [
        '/reviewer/apply',
        '/reviewer/draft',
        '/checker',
        '/checker/toDraft',
        '/reviewer/draft/upload',
        '/admin',
        '/admin/reviewer_admin'
    ];

    // 判断请求路径决定左侧导航按钮的高亮
    $(function () {
        var toggles = $('.nav-toggle');
        var url = location.pathname;
        if(url == url_arr[0]) {
            $($(toggles[0]).parent()).addClass('active open');
        }
        else if(url == url_arr[1]) {
            $($(toggles[2]).parent()).addClass('active open');
        }
        else if(url == url_arr[2]) {
            $($(toggles[0]).parent()).addClass('active open');
        }
        else if(url == url_arr[3]) {
            $($(toggles[1]).parent()).addClass('active open');
        }
        else if(url == url_arr[4]) {
            $($(toggles[1]).parent()).addClass('active open');
        }
        else if(url == url_arr[5]) {
            $($(toggles[0]).parent()).addClass('active open');
        }
        else if(url == url_arr[6]) {
            $($(toggles[1]).parent()).addClass('active open');
        }
    });

    // 设置 ajax 请求加载中动画
    $(document).ajaxStart(function(){
        $.blockUI({
            message: $('#loading'),
            css: {
                top:  ($(window).height() - 600) /2 + 'px',
                left: ($(window).width() - 400) /2 + 'px',
                width: '400px',
                border: 'none'
            },
            overlayCSS: { backgroundColor: '#fff' }
        });
    }).ajaxStop($.unblockUI);

    // 切换不同状态分类
    function changeType(key,type) {
        var now = url_arr[key];
        if(location.pathname != now) {
            if(type == 0)
                location.href = now;
            else
                location.href = now + '?type=' + type;
        } else {
            Table.search(typeArr[type]).draw();
        }
    }

    // 切换人员管理的状态
    function changeRole(type) {
        var now = '/admin/reviewer_admin';
        if(location.pathname != now) {
            if(type == 0)
                location.href = now;
            else
                location.href = now + '?type=' + type;
        } else {
            Table1.search(typeArr[type]).draw();
        }
    }


</script>
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>