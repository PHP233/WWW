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
            <a href="index.html">
                <img src="{{ asset('') }}" alt="logo" class="logo-default" /> </a>
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
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <span class="badge badge-default"> 7 </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>
                                <span class="bold">12 pending</span> notifications</h3>
                            <a href="page_user_profile_1.html">view all</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">just now</span>
                                        <span class="details">
                                                    <span class="label label-sm label-icon label-success">
                                                        <i class="fa fa-plus"></i>
                                                    </span> New user registered. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">3 mins</span>
                                        <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-bolt"></i>
                                                    </span> Server #12 overloaded. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">10 mins</span>
                                        <span class="details">
                                                    <span class="label label-sm label-icon label-warning">
                                                        <i class="fa fa-bell-o"></i>
                                                    </span> Server #2 not responding. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">14 hrs</span>
                                        <span class="details">
                                                    <span class="label label-sm label-icon label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </span> Application error. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">2 days</span>
                                        <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-bolt"></i>
                                                    </span> Database overloaded 68%. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">3 days</span>
                                        <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-bolt"></i>
                                                    </span> A user IP blocked. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">4 days</span>
                                        <span class="details">
                                                    <span class="label label-sm label-icon label-warning">
                                                        <i class="fa fa-bell-o"></i>
                                                    </span> Storage Server #4 not responding dfdfdfd. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">5 days</span>
                                        <span class="details">
                                                    <span class="label label-sm label-icon label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </span> System Error. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">9 days</span>
                                        <span class="details">
                                                    <span class="label label-sm label-icon label-danger">
                                                        <i class="fa fa-bolt"></i>
                                                    </span> Storage server failed. </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN INBOX DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-envelope-open"></i>
                        <span class="badge badge-default"> 4 </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>You have
                                <span class="bold">7 New</span> Messages</h3>
                            <a href="app_inbox.html">view all</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                <li>
                                    <a href="#">
                                                <span class="photo">
                                                    <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                                    <span class="from"> Lisa Wong </span>
                                                    <span class="time">Just Now </span>
                                                </span>
                                        <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                                <span class="photo">
                                                    <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                                    <span class="from"> Richard Doe </span>
                                                    <span class="time">16 mins </span>
                                                </span>
                                        <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                                <span class="photo">
                                                    <img src="../assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                                    <span class="from"> Bob Nilson </span>
                                                    <span class="time">2 hrs </span>
                                                </span>
                                        <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                                <span class="photo">
                                                    <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                                    <span class="from"> Lisa Wong </span>
                                                    <span class="time">40 mins </span>
                                                </span>
                                        <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                                <span class="photo">
                                                    <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                        <span class="subject">
                                                    <span class="from"> Richard Doe </span>
                                                    <span class="time">46 mins </span>
                                                </span>
                                        <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- END INBOX DROPDOWN -->
                <!-- BEGIN TODO DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-calendar"></i>
                        <span class="badge badge-default"> 3 </span>
                    </a>
                    <ul class="dropdown-menu extended tasks">
                        <li class="external">
                            <h3>You have
                                <span class="bold">12 pending</span> tasks</h3>
                            <a href="app_todo.html">view all</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                <li>
                                    <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">New release v1.2 </span>
                                                    <span class="percent">30%</span>
                                                </span>
                                        <span class="progress">
                                                    <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </span>
                                                </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Application deployment</span>
                                                    <span class="percent">65%</span>
                                                </span>
                                        <span class="progress">
                                                    <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">65% Complete</span>
                                                    </span>
                                                </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Mobile app release</span>
                                                    <span class="percent">98%</span>
                                                </span>
                                        <span class="progress">
                                                    <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">98% Complete</span>
                                                    </span>
                                                </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Database migration</span>
                                                    <span class="percent">10%</span>
                                                </span>
                                        <span class="progress">
                                                    <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">10% Complete</span>
                                                    </span>
                                                </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Web server upgrade</span>
                                                    <span class="percent">58%</span>
                                                </span>
                                        <span class="progress">
                                                    <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">58% Complete</span>
                                                    </span>
                                                </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">Mobile development</span>
                                                    <span class="percent">85%</span>
                                                </span>
                                        <span class="progress">
                                                    <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">85% Complete</span>
                                                    </span>
                                                </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                                <span class="task">
                                                    <span class="desc">New UI release</span>
                                                    <span class="percent">38%</span>
                                                </span>
                                        <span class="progress progress-striped">
                                                    <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">38% Complete</span>
                                                    </span>
                                                </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- END TODO DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <span class="username username-hide-on-mobile"> {{ $reviewer == null? '' : $reviewer->name }} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="page_user_profile_1.html">
                                <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li>
                            <a href="app_calendar.html">
                                <i class="icon-calendar"></i> My Calendar </a>
                        </li>
                        <li>
                            <a href="app_inbox.html">
                                <i class="icon-envelope-open"></i> My Inbox
                                <span class="badge badge-danger"> 3 </span>
                            </a>
                        </li>
                        <li>
                            <a href="app_todo.html">
                                <i class="icon-rocket"></i> My Tasks
                                <span class="badge badge-success"> 7 </span>
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="page_user_lock_1.html">
                                <i class="icon-lock"></i> Lock Screen </a>
                        </li>
                        <li>
                            <a href="{{ route('reviewer_logout') }}">
                                <i class="icon-key"></i> Log Out </a>
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
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    @section('level_link')
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">Tables</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Datatables</span>
                    </li>
                    @show
                </ul>
            </div>
            <!-- END PAGE BAR -->
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
                                <span id="sign" class="text-success"></span>
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
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div id="loading" hidden><img src="{{ asset('static/assets/img/loading.gif') }}" alt="loading"></div>
<div class="page-footer">
    <div class="page-footer-inner"> 2014 &copy; Metronic by keenthemes.
        <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
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
@yield('javascript')
<script>

    const url_arr = [
        '/genec/public/reviewer/apply',
        '/genec/public/reviewer/draft/upload',
        '/genec/public/reviewer/draft',
        '/genec/public/reviewer/reviewer_admin',
    ];

    // 判断请求路径决定左侧导航按钮的高亮
    $(function () {
        var toggles = $('.nav-toggle');
        var url = location.pathname;
        if(url == url_arr[0]) {
            $($(toggles[0]).parent()).addClass('active open');
        } else if(url == url_arr[1]) {
            $($(toggles[1]).parent()).addClass('active open');
        } else if(url == url_arr[2]) {
            $($(toggles[2]).parent()).addClass('active open');
        } else if(url == url_arr[3]) {
            $($(toggles[3]).parent()).addClass('active open');
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

    // 切换申请书不同状态分类
    function changeApplyType(type) {
        var now = url_arr[0];
        if(location.pathname != now) {
            if(type == 0)
                location.href = now;
            location.href = now + '?type=' + type;
        }
        Table.search(typeArr[type]).draw();
    }

    // 跳转到送审表管理并按状态分类
    function changeDraftType(type) {
        var now = url_arr[2];
        if(location.pathname != now) {
            if(type == 0)
                location.href = now;
            location.href = now + '?type=' + type;
        }
        Table2.search(typeArr[type]).draw();
    }

    // 跳转到审议人管理页面
    function toReviewerAdmin() {
        var now = '{{ route('reviewer_admin') }}';
        if(location.href != now) {
            window.location.href = now;
        }
    }
</script>
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>