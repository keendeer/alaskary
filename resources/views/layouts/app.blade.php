<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Emad Elrouby">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/custom-rtl.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/core/menu/menu-types/vertical-overlay-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/pages/single-page.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style-rtl.css')}}">
    <!-- END: Custom CSS-->

    @yield('header')

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        
        .dropdown .dropdown-menu .dropdown-item,span , p, h2, h3,li,a, .table th, .table td, label, .dataTables_info, h4, button, ::-webkit-input-placeholder, .toast-title, .toast-message, input, textarea, .icheckbox_line-orange, .iradio_line-orange, .swal2-popup #swal2-content{
            font-family: 'Tajawal', sans-serif !important; font-weight: 500 !important;
        }
        .dataTables_wrapper .dataTables_paginate{
            float: left;
        }
        .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_info{
            float: right;
        }
        .dataTables_wrapper .dataTables_filter input{
            margin-right: 0.5em; margin-left: auto;
        }
        table.dataTable tr{
                background: #666EE8;
        }
        table.dataTable thead th, table.dataTable tfoot th{
            padding: 15px 25px; color: #fff; font-size: 16px; border: none; 
        }
        table.dataTable tbody th, table.dataTable tbody td{
            padding: 15px 25px;  font-size: 16px; border: none; 
        }
        table.dataTable tbody td .form-group{
            margin-bottom: auto;
        }
        .btn11{
                padding: 6px 6px 3px 6px;
        }
        .lopa{
            line-height: 40px;
        }

    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-overlay-menu 2-columns non-printable fixed-navbar" data-open="click" data-menu="vertical-overlay-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark bg-secondery navbar-shadow navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item">
                        <a class="navbar-brand text-center" href="" style="padding: 7px 0;">
                            <img class="brand-logo" style="width: auto; max-width: 35%;" alt="" src="{{asset('app-assets/images/logo/logo-dark.png')}}">
                        </a>
                    </li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>          
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        
                        <!-- <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                                <i class="ficon ft-bell"></i><span class="badge badge-pill badge-danger badge-up badge-glow">5</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail"></i></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-footer">
                                    <a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all messages</a>
                                </li>
                            </ul>
                        </li>-->
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="mr-1 user-name text-bold-700">{{Auth::user()->name}}</span>
                                <span class="avatar avatar-online">
                                    <img src="{{asset('app-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        <i class="ft-power"></i> تسجيل الخروج
                                    </a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu -->

    <div class="main-menu menu-fixed menu-dark menu-accordion menu-bordered menu-shadow menu-border" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item"><a href="#"><i class="la la-money"></i><span class="menu-title" data-i18n="Contacts">شاشات البيع</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{route('salesorder.index')}}"><i></i><span data-i18n="Primary palette">اوامر / تقارير البيع</span></a>
                        </li>
                        <li><a class="menu-item" href="{{route('item.index')}}"><i></i><span data-i18n="Primary palette">المرتجعات</span></a>
                        </li>
                       <li class="nav-item"><a href="{{route('client.index')}}"><i></i><span class="menu-title" data-i18n="Contacts">العملاء</span></a>
                    </ul>
                </li>
                <li class="nav-item"><a href="#"><i class="la la-sitemap"></i><span class="menu-title" data-i18n="Contacts">المخازن / الأفرع</span></a>
                    <ul class="menu-content">
                        @if(Auth::user()->hasPermission('branch', 'index'))
                        <li><a class="menu-item" href="{{route('branch.index')}}"><i></i><span data-i18n="Primary palette">التحكم بالأصناف</span></a>
                        </li>
                        @endif
                        <li><a class="menu-item" href="{{route('exchange.index')}}"><i></i><span data-i18n="Danger palette">تقارير المخازن</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#"><i class="la la-sitemap"></i><span class="menu-title" data-i18n="Contacts">شاشات البضاعة</span></a>
                    <ul class="menu-content">
                        @if(Auth::user()->hasPermission('item', 'index'))
                        <li><a class="menu-item" href="{{route('item.index')}}"><i></i><span data-i18n="Primary palette">المنتجات</span></a>
                        </li>
                        @endif
                        @if(Auth::user()->hasPermission('category', 'index'))
                        <li><a class="menu-item" href="{{route('category.index')}}"><i></i><span data-i18n="Danger palette">التصنيفات</span></a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="Contacts">الموظفين</span></a>
                    <ul class="menu-content">
                        <li class="nav-item"><a href="{{route('user.index')}}"><i></i><span class="menu-title" data-i18n="Contacts">مستخدمين النظام</span></a>
                        </li>
                        <li><a class="menu-item" href="{{route('employee.index')}}"><i></i><span data-i18n="Danger palette">البائعين</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <!-- END: Main Menu -->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title mb-0">{{$page_title}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">لوحة التحكم</a>
                                </li>
                                <li class="breadcrumb-item active">عنوان الصفحة
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-6 col-12">
                    <div class="btn-group">
                        @if(isset($module_name) || isset($module_name_ar))
                        <a href="{{route($module_name)}}" class="btn btn-round btn-info mb-1"><i class="la la-plus"></i> أضافة {{$module_name_ar}} جديد</a>
                        @endif

                    </div>
                </div>
            </div>

            <div class="content-body">
                
                @yield('content')

            </div>

        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block"> 
                جميع الحقوق محفوظه &copy; 2021 مؤسسة العسكرى للاستيراد والتصدير.
            </span>
            <span class="float-md-right d-none d-lg-block">
                تم بواسطه <a href="https://keendeer.com" target="_blank">كين دير.</a>
            </span>
        </p>
    </footer>
    <!-- END: Footer-->

   <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    @yield('footer-top')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    @yield('footer-bottom')
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>    