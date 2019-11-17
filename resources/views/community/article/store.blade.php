@extends('app')

@section('css')
    <link href="https://cdn.bootcss.com/simplemde/1.11.2/simplemde.min.css" rel="stylesheet">
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/simplemde/1.11.2/simplemde.min.js"></script>
@endsection

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
        <div class="row">
            <div id="article-data" class="col-md-9">
                <article-data></article-data>
            </div>
            <div class="col-md-3">create</div>
        </div>
    </div>
    @include('community.article.article-data')
@endsection
