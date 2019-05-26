<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::check() ? 'Bearer '.Auth::user()->api_token : 'Bearer ' }}">
    <title>@yield('title','WarshipCommunity')</title>
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    @yield('css')
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.bootcss.com/vue/2.5.21/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
    <script src="https://cdn.bootcss.com/lodash.js/4.17.11/lodash.min.js"></script>
    @include('community.global-constant')
    @include('community.global-config')
    @include('community.global-function')
    @yield('js')
</head>
<body style="min-width: 1600px">
<!-- head -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav col-md-6 mr-5">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <ul class="navbar-nav col-md-3 mr-5">
            <li class="nav-item">
                <div class="form-inline">
                    <input class="form-control mr-md-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">
                        <i class="fa fa-search"></i> 搜索
                    </button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav col-md-2">
            <li class="nav-item mr-md-2">
                <a type="button" class="btn btn-outline-primary"
                   href="/user/register?target=sign-in">登录</a>
            </li>
            <li class="nav-item">
                <a type="button" class="btn btn-outline-primary"
                   href="/user/register?target=sign-up">注册</a>
            </li>
        </ul>
    </div>
</nav>
<div class="jumbotron text-center">
    <p class="lead">公告</p>
    <hr class="my-4">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-item nav-link active" href="#">Active</a>
        <a class="nav-item nav-link" href="#">Link</a>
        <a class="nav-item nav-link" href="#">Link</a>
        <a class="nav-item nav-link disabled" href="#">Disabled</a>
    </nav>
</div>
<!-- body -->
<div class="container" style="min-width: 1600px">
    @yield('body')
</div>
<!-- foot -->
<div>
</div>
</body>
</html>