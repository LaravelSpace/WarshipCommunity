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
            <div class="col-md-9">
                <div id="article-data">
                    <article-data></article-data>
                </div>
            </div>
            <div class="col-md-3">edit</div>
        </div>
    </div>
    @include('community.article.article-data')
@endsection
