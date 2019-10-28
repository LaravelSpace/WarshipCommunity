<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::check() ? 'Bearer' . Auth::user()->api_token : 'Bearer' }}">
    <title>@yield('title','WarshipCommunity')</title>
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    @yield('css')
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.bootcss.com/vue/2.5.21/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
    {{--<script src="https://cdn.bootcss.com/lodash.js/4.17.11/lodash.min.js"></script>--}}
    @yield('js')
    @include('common.global-constant')
    @include('common.global-config')
    @include('common.global-function')
</head>
<body style="min-width: 1600px">
<!-- head -->
@include('common.navbar')
<div class="jumbotron text-center">
    <p class="lead">公告</p>
    <hr class="my-4">
    <p>破站第 13 次重构进行中...</p>
</div>
<!-- body -->
@yield('body')
<!-- foot -->
{{--@include('community.common.live2d')--}}
</body>
</html>