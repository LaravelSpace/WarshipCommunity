@extends('app')

@section('body')
    <div id="main-body" class="container">
        <vue-article></vue-article>
    </div>

    <template id="template-vue-article">
        <div class="row">
            <div class="col-md-9">
                <div id="article-item">
                    <article-item v-bind:article_id="articleId"></article-item>
                </div>
                <div id="comment-list">
                    <comment-list v-bind:article_id="articleId"></comment-list>
                </div>
                <div id="comment-data">
                    <comment-data v-bind:article_id="articleId"></comment-data>
                </div>
            </div>
            <div class="col-md-3">
                <div id="vue-cropper">
                    <vue-cropper></vue-cropper>
                </div>
            </div>
        </div>
    </template>
    <script>
        Vue.component("vue-article", {
            template: "#template-vue-article",
            data: function () {
                return {articleId: 0}
            },
            created: function () {
                let thisVue = this;
                let uriArr = gGetUrIArr(window.location.href);
                thisVue.articleId = uriArr[uriArr.length - 1];
            }
        });
        new Vue({el: "#main-body"});
    </script>

    @include('community.article.article-item')
    @include('community.article.comment-list')
    @include('community.article.comment-data')
    @include('community.article.cropper')
@endsection
