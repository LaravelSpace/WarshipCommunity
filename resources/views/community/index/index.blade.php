@extends('community.app')

@section('title')
    WarshipCommunity
@endsection

@section('body')
    <div class="row">
        <div id="article-list" class="col-md-9">
            <vue-article-list></vue-article-list>
        </div>
        <div class="col-md-3">3</div>
    </div>

    <template id="template-article-list">
        <ul class="list-unstyled" v-if="vifShow">
            <li class="media" v-for="article in articleList">
                <img class="rounded-circle mr-3" style="width: 50px; height: 50px" src="" :src="article.user.avatar" alt="" :alt="article.user_id">
                <div class="media-body">
                    <h5 class="mt-0 mb-1">@{{ article.title }}</h5>
                    <p>@{{ article.main_body }}</p>
                </div>
            </li>
        </ul>
    </template>

    <script>
        Vue.component('vue-article-list', {
            template: '#template-article-list',
            data: function () {
                return {
                    articleList: [],
                    vifShow: false
                }
            },
            created: function () {
                this.init();
            },
            methods: {
                init: function () {
                    this.getArticleList();
                },
                getArticleList: function () {
                    let thisVue = this;
                    axios.get('/community/article/list')
                        .then(function (response) {
                            thisVue.articleList = response.data.data;
                            if (thisVue.articleList.length > 0) {
                                thisVue.vifShow = true;
                            }
                        })
                        .catch(function (response) {
                            console.log(response.status);
                            console.log(response.headers);
                            console.log(response.data);
                        });
                }
            }
        });
        new Vue({el: "#article-list"});
    </script>
@endsection