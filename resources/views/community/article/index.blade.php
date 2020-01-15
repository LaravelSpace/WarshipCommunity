@extends('app')

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
        <div class="row">
            <div id="article-list" class="col-md-9">
                <article-list></article-list>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <a class="btn btn-lg btn-outline-success" href="/article/create">创建帖子</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('community.article.article-list')
@endsection
