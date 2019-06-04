@extends('community.app')

@section('body')
    <div class="row">
        <div id="article-list" class="col-md-9">
            <vue-article-list></vue-article-list>
        </div>
        <div class="col-md-3">
            <a class="btn btn-outline-primary" href="/articles/create">创建帖子</a>
        </div>
    </div>
    @include('community.article.article-list')
@endsection