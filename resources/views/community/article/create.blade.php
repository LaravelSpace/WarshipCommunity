@extends('community.app')

@section('body')
    <div class="row">
        <div id="article-data" class="col-md-9">
            <vue-article-data></vue-article-data>
        </div>
        <div class="col-md-3">create</div>
    </div>
    @include('community.article.article-data')
@endsection