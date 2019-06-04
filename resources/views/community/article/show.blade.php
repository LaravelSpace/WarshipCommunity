@extends('community.app')

@section('body')
    <div class="row">
        <div id="article-item" class="col-md-9">
            <vue-article-item></vue-article-item>
        </div>
        <div class="col-md-3">show</div>
    </div>

    <template id="template-article-item">
        <div v-if="vifShow">
            <a href="#" :href="['/articles/'+articleItem.id]+'/edit'"><h5 class="mt-0 mb-1">修改帖子</h5></a>
            <h1>@{{ articleItem.title }}</h1>
            <p>@{{ articleItem.main_body }}</p>
        </div>
    </template>
    <script>
        Vue.component("vue-article-item", {
            template: "#template-article-item",
            data: function () {
                return {
                    articleId: 0,
                    articleItem: "",
                    vifShow: false
                }
            },
            created: function () {
                this.init();
            },
            methods: {
                init: function () {
                    this.getArticleItem();
                },
                getArticleItem: function () {
                    let thisVue = this;
                    let localUrl = window.location.href;
                    let localUrlArray = gSplitUrl(localUrl);
                    thisVue.articleId = localUrlArray[localUrlArray.length - 1];
                    let url = COMMUNITY_URL.articles + '/' + thisVue.articleId + '?' + COMMUNITY_URL.need_data;
                    axios.get(url)
                        .then(function (response) {
                            thisVue.articleItem = response.data.data;
                            if (thisVue.articleItem !== null) {
                                thisVue.vifShow = true;
                            }
                        })
                        .catch(function (error) {
                            console.error(error.response);
                        });
                }
            }
        });
        new Vue({el: "#article-item"});
    </script>
@endsection