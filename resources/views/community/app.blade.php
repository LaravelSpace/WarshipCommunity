<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-token" content="{{ Auth::check() ? 'Bearer '.Auth::user()->api_token : 'Bearer ' }}">
    <title>@yield('title','WarshipCommunity')</title>
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/live2d/css/live2d.css" rel="stylesheet">
    @yield('css')
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.bootcss.com/vue/2.5.21/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
    {{--<script src="https://cdn.bootcss.com/lodash.js/4.17.11/lodash.min.js"></script>--}}
    @yield('js')
    @include('community.global-constant')
    @include('community.global-config')
    @include('community.global-function')
</head>
<body style="min-width: 1600px">
<!-- head -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">冷月</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav col-md-6 mr-5">
            <li class="nav-item active">
                <a class="nav-link" href="/articles">帖子</a>
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
    <p>破站第 13 次重构进行中...</p>
</div>
<!-- body -->
<div class="container" style="min-width: 1600px">
    @yield('body')
</div>
<!-- foot -->
<div>
    <div id="landlord" style="left:5px;bottom:0px;">
        <div class="message" style="opacity:0"></div>
        <canvas id="live2d" width="500" height="560" class="live2d"></canvas>
        <div class="live_talk_input_body">
            <div class="live_talk_input_name_body">
                <input name="name" type="text" class="live_talk_name white_input" id="AIuserName" autocomplete="off" placeholder="你的名字" />
            </div>
            <div class="live_talk_input_text_body">
                <input name="talk" type="text" class="live_talk_talk white_input" id="AIuserText" autocomplete="off" placeholder="要和我聊什么呀？"/>
                <button type="button" class="live_talk_send_btn" id="talk_send">发送</button>
            </div>
        </div>
        <input name="live_talk" id="live_talk" value="1" type="hidden" />
        <div class="live_ico_box">
            <div class="live_ico_item type_info" id="showInfoBtn"></div>
            <div class="live_ico_item type_talk" id="showTalkBtn"></div>
            <div class="live_ico_item type_music" id="musicButton"></div>
            <div class="live_ico_item type_youdu" id="youduButton"></div>
            <div class="live_ico_item type_quit" id="hideButton"></div>
            <input name="live_statu_val" id="live_statu_val" value="0" type="hidden" />
            {{--<audio src="" style="display:none;" id="live2d_bgm" data-bgm="0" preload="none"></audio>--}}
            {{--<input name="live2dBGM" value="音乐地址" type="hidden">--}}
            <input id="duType" value="douqilai,l2d_caihong" type="hidden">
        </div>
    </div>
    <div id="open_live2d">召唤伊斯特瓦尔</div>
</div>
<script>
    var message_Path = '/live2d/';//资源目录，如果目录不对请更改
    var talkAPI = "/live2d/";//如果有类似图灵机器人的聊天接口请填写接口路径
</script>
<script type="text/javascript" src="/live2d/js/live2d.js"></script>
<script type="text/javascript" src="/live2d/js/message.js"></script>
</body>
</html>