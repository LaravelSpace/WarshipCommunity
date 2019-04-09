<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::check() ? 'Bearer '.Auth::user()->api_token : 'Bearer ' }}">
    <title>@yield('title','WarshipCommunity')</title>
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    @yield('css')
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/vue/2.5.21/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
    <script src="https://cdn.bootcss.com/lodash.js/4.17.11/lodash.min.js"></script>
    <script>
        // 这段代码为所有的 Ajax 和 Axios 请求添加 CSRF-TOKEN，因此需要在所有的请求发起之前执行
        // 别放在 $(document).ready(function () {}) 里面，也别放在页面底部
        let csrfToken = document.head.querySelector('meta[name="csrf-token"]');
        let apiToken = document.head.querySelector('meta[name="csrf-token"]');
        if (csrfToken != null && apiToken != null) {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            //         'Authorization': $('meta[name="api-token"]').attr('content')
            //     }
            // });
            window.jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken.content,
                    'Authorization': apiToken.content
                }
            });
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content;
        } else {
            if (csrfToken == null) {
                console.error('CSRF token not found');
            } else if (apiToken == null) {
                console.error('API token not found');
            }
        }
    </script>
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
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav col-md-2">
            <li class="nav-item mr-md-2">
                <button type="button" class="btn btn-outline-primary">Login</button>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-outline-primary">Register</button>
            </li>
        </ul>
    </div>
</nav>
<div class="jumbotron text-center">
    <h1 class="display-4">判天地之美，析万物之理！</h1>
    <p class="lead">判天地之美，析万物之理！</p>
    <hr class="my-4">
    <p>判天地之美，析万物之理！</p>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </p>
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