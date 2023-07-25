<!DOCTYPE html>
<html class="loading light-layout {{\Auth::guard('admin')->user()->is_dark == 1 ? 'dark-layout' : ''}}" lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}" data-textdirection="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    {{-- <base href"{{asset('assets')}}/"> --}}
    <title>@lang("Aictec Ecommerce") - @yield('head_title')</title>
    @include('admin.layouts.inc.styles')
    <!-- BEGIN: loader-->
    {!! assetAdmin('app-assets/loader/loader.css','css') !!}
    <!-- END: loader-->
    <!-- BEGIN: loader-->
    {!! assetAdmin('app-assets/loader/loader.js','js') !!}
    <!-- END: loader-->
</head>
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="" style="position: relative">
    <div class="loader">
        <div class="book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="project_name">@lang("Aictec Ecommerce")</div>
    </div>
    <!-- BEGIN: Header-->
    @include('admin.layouts.topNavBar')
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow {{\Auth::guard('admin')->user()->is_dark == 1 ? 'menu-dark' : 'menu-light'}}" data-scroll-to-active="true">
        <div class="navbar-header">
            <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
            </a>
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{route('app.dashboard')}}">
                        <span class="brand-logo">
                            <img src="{{app_settings()->logo_path}}" style="max-height: 50px;max-width: 100% !important;" alt="{{ __(env('APP_NAME')) }}">
                        </span>
                        <h5 class="brand-text">@lang(app_settings()->title)</h5>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            @include('admin.layouts.rightNavBar')
        </div>
    </div>
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="header pb-8">
                {{-- @yield('back_button') --}}
                @yield('dashboard')
            </div>
            @yield('breadcrumb')
            <div class="container-fluid mt--7">
                <section id="loading">
                    <div id="loading-content"></div>
                </section>
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('admin.layouts.footer')
    @include('admin.layouts.inc.scripts')
</body>
</html>
