@extends('community.app')

@section('body')
    <div class="row">
        <div id="article-list" class="col-md-9">
            <vue-article-list></vue-article-list>
        </div>
        <div class="col-md-3">3</div>
    </div>
    @include('community.components.article-list')
@endsection