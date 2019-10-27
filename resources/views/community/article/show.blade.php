@extends('app')

@section('body')
    <div class="row">
        <div id="article-item" class="col-md-9">
            <vue-article-item></vue-article-item>
        </div>
        <div class="col-md-3">show</div>
    </div>

    <template id="template-article-item">
        <div v-if="vifShow">
            <a href="#" :href="editUrl"><h5 class="mt-0 mb-1">修改帖子</h5></a>
            <a href="#" :href="deleteUrl"><h5 class="mt-0 mb-1">删除帖子</h5></a>
            <h1>@{{ article.title }}</h1>
            {{--<p>@{{ article.body }}</p>--}}
            <div v-html="article.body"></div>
        </div>
    </template>
    <script>
        Vue.component("vue-article-item", {
            template: "#template-article-item",
            data: function () {
                return {
                    articleId: 0, article: '', editUrl: '',deleteUrl:'', vifShow: false
                }
            },
            created: function () {
                this.init();
            },
            methods: {
                init: function () {
                    this.getArticleItem();
                    this.editUrl = COMMUNITY_WEB_URL.article + '/' + this.articleId + COMMUNITY_URL.edit;
                    this.deleteUrl = COMMUNITY_API_URL.article + '/' + this.articleId + COMMUNITY_URL.destroy;
                },
                getArticleItem: function () {
                    let thisVue = this;
                    let localUrl = window.location.href;
                    let localUrlArray = gSplitUrl(localUrl);
                    thisVue.articleId = localUrlArray[localUrlArray.length - 1];
                    let url = COMMUNITY_API_URL.article + '/' + thisVue.articleId;
                    axios.get(url).then(function (response) {
                        thisVue.article = response.data.data;
                        if (thisVue.article !== null) {
                            thisVue.vifShow = true;
                        }
                    }).catch(function (error) {
                        console.error(error.response);
                    });
                }
            }
        });
        new Vue({el: "#article-item"});
    </script>
@endsection