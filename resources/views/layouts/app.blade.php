<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    {{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    <title>ERP - @yield('title', config('app.name', 'Laravel'))</title>
    <meta name="keywords" content="{{ config('app.name', 'Laravel') }}">
    <meta name="description" content="{{ config('app.name', 'Laravel') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.structure.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.appendGrid-1.7.1.css') }}" rel="stylesheet">
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
    @yield('css')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:auto">
@inject('menus','App\Services\Menu')
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @guest
                        @else
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url('/home') }}">Home</a></li>

                                @foreach($menus->parent_menus as $parent_menu)
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                {{$parent_menu->display_name}}
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu">
                                                @foreach($menus->sub_menus as $key => $submenu)
                                                    @foreach($submenu as $subs)
                                                        @if($subs->parent_id == $parent_menu->id)
                                                        <li>
                                                            <a href="{{route($subs->route)}}">{{$subs->display_name}}</a>
                                                        </li>
                                                        @endif
                                                    @endforeach

                                                @endforeach
                                            </ul>
                                        </li>
                                @endforeach

                                {{--<li><a href="{{ route('users.index') }}">Users</a></li>--}}
                                {{--<li><a href="{{ route('roles.index') }}">Roles</a></li>--}}
                                {{--<li><a href="{{ route('permissions.index') }}">Permissions</a></li>--}}
                                {{--<li><a href="{{ route('company.index') }}">Company</a></li>--}}
                                {{--<li><a href="{{ route('customer.index') }}">Customer</a></li>--}}
                                {{--<li><a href="{{ route('manufacturer.index') }}">Manufacturer</a></li>--}}
                            </ul>
                        @endguest

                        <!-- Right Side Of Navbar -->
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                @guest
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    @else
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                               aria-expanded="false" aria-haspopup="true">
                                                {{ Auth::user()->user_name }} <span class="caret"></span>
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="{{ route('users.edit_profile',Auth::user()->user_id) }}">
                                                        更新個人資料
                                                    </a>
                                                    <a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                          style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                        @endguest
                            </ul>
                </div>
            </div>
    </nav>
</div>
@yield('content')

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.aCollapTable.js') }}"></script>
<script src="{{ asset('js/jquery.appendGrid-1.7.1.js') }}"></script>
<script src="{{ asset('js/jquery-ui-1.12.1.min.js') }}"></script>
@yield('js')

{{--<script>--}}
{{--$(function () {--}}
{{--$("#side-menu").metisMenu();--}}
{{--})--}}
{{--$('div.alert').not('.alert-important').delay(3000).fadeOut(350);--}}
{{--</script>--}}
@yield('footer-js')
</body>
</html>
