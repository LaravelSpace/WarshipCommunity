@extends('app')

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
        <div class="row">
            <div id="article-data" class="col-md-9">
                <article-data></article-data>
            </div>
            <div class="col-md-3">
                <div id="vue-cropper">
                    <vue-cropper></vue-cropper>
                </div>
            </div>
        </div>
    </div>
    @include('community.article.article-data')
    @include('community.article.cropper')
@endsection
