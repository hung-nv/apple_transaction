<!DOCTYPE html>
<html lang="en" class="ie8 no-js">
<html lang="en" class="ie9 no-js">
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="author"/>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="shortcut icon" href="{{ asset('/admin/images/favicon.ico') }}"/>

    @include('backend.layouts.css.core')
    @yield('style')
    @include('backend.layouts.css.layouts')
</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-container-bg-solid">

@include('backend.layouts.header')

<div class="clearfix"></div>

<div class="page-container mainComponent" id="@yield('pageId')">

    @include('backend.layouts.sidebar')

    <div class="page-content-wrapper">
        <div class="page-content">

            @include('backend.layouts.breadcrumbs')

            @yield('content')
        </div>
    </div>

</div>

<div class="page-footer">
    <div class="page-footer-inner"> 2014 &copy; Administrator by hungnv234@gmail.com
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
@include('backend.layouts.js.core')

@include('backend.layouts.js.global')

@stack('script')

@include('backend.layouts.js.layouts')

</body>

</html>