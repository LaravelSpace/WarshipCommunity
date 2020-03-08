@extends('app')

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
        <div class="row">
            <div class="col-md-3">
                <nav class="nav flex-column">
                    <a class="nav-link" href="/user/index">个人中心</a>
                    <a class="nav-link active" href="/user/info">我的信息</a>
                    <a class="nav-link" href="/user/avatar">我的头像</a>
                </nav>
            </div>
            <div class="col-md-9">

            </div>
        </div>
    </div>
@endsection