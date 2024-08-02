<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{getConfig('config_app_name') ?? ''}} - @yield('title')</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="CodeHunger Easy Hrm">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
         =========================================================
         * ArchitectUI HTML Theme Dashboard - v1.0.0
         =========================================================
         * Product Page: https://dashboardpack.com
         * Copyright 2019 DashboardPack (https://dashboardpack.com)
         * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
         =========================================================
         * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
         -->
    <link rel="icon" href="{{getConfig('config_app_favicon_icon') ?? '' }}" type="image/gif" sizes="16x16">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow {{ getConfig('config_is_footer_fixed') }}
    {{ getConfig('config_is_sidebar_fixed') }}  {{ getConfig('config_is_header_fixed') }}">
        @if(Request::url() == url('/login'))
            @yield('auth')
        @else
        @include('admin.layouts.header')
        <div class="app-main">
            @include('admin.layouts.sidebar')
            <div class="app-main__outer">
                @yield('content')
                @include('admin.layouts.footer')
            </div>
        </div>
        @endif
    </div>
    @include('admin.layouts.alert')
    <!----Complied Js File---->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/assets/plugins/tinymce/tinymce.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
