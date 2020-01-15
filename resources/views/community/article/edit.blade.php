@extends('app')

@section('css')
    <link href="https://cdn.bootcss.com/simplemde/1.11.2/simplemde.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/cropperjs/1.5.6/cropper.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/simplemde/1.11.2/simplemde.min.js"></script>
    <script src="https://cdn.bootcss.com/cropperjs/1.5.6/cropper.min.js"></script>
@endsection

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
        <div class="row">
            <div class="col-md-9">
                <div id="article-data">
                    <article-data></article-data>
                </div>
            </div>
            <div class="col-md-3">
                <div id="vue-cropper">
                    <vue-cropper></vue-cropper>
                </div>
            </div>
        </div>
    </div>
    @include('community.article.article-data')
    @include('common.cropper')
@endsection
