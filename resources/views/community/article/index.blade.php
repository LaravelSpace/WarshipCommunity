@extends('app')

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
        <div class="row">
            <div class="col-md-9">
                <div id="article-list">
                    <vue-article-list></vue-article-list>
                </div>
            </div>
            <div class="col-md-3">
                <a class="btn btn-outline-primary" href="/article/store">创建帖子</a>
            </div>
        </div>
    </div>
    @include('community.article.article-list')
@endsection
