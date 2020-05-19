<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<meta name="api-token" content="{{ Auth::check() ? 'Bearer' . Auth::user()->api_token : 'Bearer' }}">--}}
    <title>@yield('title','KTCommunity')</title>
    {{--BootCDN--}}
    {{--<link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">--}}
    {{--<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">--}}
    {{--<link href="https://cdn.bootcss.com/simplemde/1.11.2/simplemde.min.css" rel="stylesheet">--}}
    {{--<link href="https://cdn.bootcss.com/cropperjs/1.5.6/cropper.min.css" rel="stylesheet">--}}
    {{--本地--}}
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/simplemde.min.css" rel="stylesheet">
    <link href="/css/cropper.min.css" rel="stylesheet">
    <link href="/css/kt-common.css" rel="stylesheet">
    @yield('css')
    {{--BootCDN--}}
    {{--<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>--}}
    {{--<script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>--}}
    {{--<script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>--}}
    {{--<script src="https://cdn.bootcss.com/vue/2.5.21/vue.min.js"></script>--}}
    {{--<script src="https://cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>--}}
    {{--<script src="https://cdn.bootcss.com/simplemde/1.11.2/simplemde.min.js"></script>--}}
    {{--<script src="https://cdn.bootcss.com/cropperjs/1.5.6/cropper.min.js"></script>--}}
    {{--<script src="https://cdn.bootcss.com/lodash.js/4.17.15/lodash.min.js"></script>--}}
    {{--本地--}}
    @include('common.global-constant')
    @include('common.global-function')
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/vue.min.js"></script>
    <script src="/js/axios.min.js"></script>
    <script src="/js/simplemde.min.js"></script>
    <script src="/js/cropper.min.js"></script>
    <script src="/js/lodash.min.js"></script>
    {{--<script src="/js/laravel-echo.js"></script>--}}
    {{--<script>--}}
    {{--    window.Echo.channel("broadcast-public")--}}
    {{--        .listen(".public-notification", (e) => {--}}
    {{--            console.log(".public-notification");--}}
    {{--            console.log(e);--}}
    {{--        });--}}
    {{--</script>--}}
    @include('common.global-config')
    @yield('js')
</head>
<body class="kt-container">
<!-- head -->
@include('common.nav-bar')
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


