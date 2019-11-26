@extends('app')

@section('body')
    <div id="main-body" class="container" style="min-width: 1600px">
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
            </div>
            <div class="col-md-3">show</div>
        </div>
    </template>
    <script>
        Vue.component("vue-article", {
            template: "#template-vue-article",
            data: function () {
                return {articleId: ''}
            },
            created: function () {
                let thisVue = this;
                let uriArr = gGetUrI(window.location.href);
                thisVue.articleId = uriArr[uriArr.length - 1];
            }
        });
        new Vue({el: "#main-body"});
    </script>

    <template id="template-article-item">
        <div class="card border-primary" v-if="vifArticleShow">
            <div class="card-header">
                <h3>
                    @{{ article.title }}
                    <a class="btn btn-danger" style="float: right;margin-right: 10px"
                       href="#" :href="deleteUrl"><h5 class="mt-0 mb-1">删除帖子</h5></a>
                    <a class="btn btn-primary" style="float: right;margin-right: 10px"
                       href="#" :href="editUrl"><h5 class="mt-0 mb-1">修改帖子</h5></a>
                </h3>
            </div>
            <div class="card-body">
                <div v-html="article.body"></div>
            </div>
        </div>
    </template>
    <script>
        Vue.component("article-item", {
            props: ['article_id'],
            template: "#template-article-item",
            data: function () {
                return {
                    articleId: this.article_id, article: '', editUrl: '', deleteUrl: '', vifArticleShow: false
                }
            },
            created: function () {
                this.getArticleItem();
                this.editUrl = URI_WEB.article + '/' + this.articleId + URI_CONFIG.edit;
                this.deleteUrl = URI_API.article + '/' + this.articleId + URI_CONFIG.destroy;
            },
            methods: {
                getArticleItem: function () {
                    let thisVue = this;
                    let uriArr = gGetUrI(window.location.href);
                    thisVue.articleId = uriArr[uriArr.length - 1];
                    let uri = URI_API.article + '/' + thisVue.articleId;
                    axios.get(uri).then(function (response) {
                        thisVue.article = response.data.data;
                        if (thisVue.article !== null && thisVue.article !== '') {
                            thisVue.vifArticleShow = true;
                        }
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                }
            }
        });
        new Vue({el: "#article-item"});
    </script>

    <template id="template-comment-list">
        <div v-if="vifCommentShow">
            <div class="card border-info" style="margin: 10px 0" v-for="comment in commentList">
                <div class="card-header">
                    <h6>
                        <img class="rounded-circle mr-3" style="width: 30px; height: 30px"
                             src="" :src="comment.user.avatar" alt="" :alt="comment.user.name">
                        @{{ comment.user.name }}
                    </h6>
                </div>
                <div class="card-body">
                    <div>@{{ comment.body }}</div>
                </div>
            </div>
        </div>
    </template>
    <script>
        Vue.component("comment-list", {
            props: ['article_id'],
            template: "#template-comment-list",
            data: function () {
                return {
                    articleId: this.article_id, commentList: [], vifCommentShow: false
                }
            },
            created: function () {
                this.getCommentList();
            },
            methods: {
                getCommentList: function () {
                    let thisVue = this;
                    let url = URI_API.article + '/' + thisVue.articleId + URI_CONFIG.comment;
                    axios.get(url).then(function (response) {
                        thisVue.commentList = response.data.data;
                        if (thisVue.commentList.length > 0) {
                            thisVue.vifCommentShow = true;
                        }
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                }
            }
        });
        new Vue({el: "#comment-list"});
    </script>
@endsection
