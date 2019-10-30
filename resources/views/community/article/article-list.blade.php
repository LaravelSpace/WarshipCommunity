<template id="template-article-list">
    <ul class="list-unstyled" v-if="vifShow">
        <li class="media" v-for="article in articleList">
            <img class="rounded-circle mr-3" style="width: 50px; height: 50px"
                 src="" :src="article.user.avatar" alt="" :alt="article.user_id">
            <div class="media-body">
                <a href="#" :href="['/article/'+article.id]">
                    <h5 class="mt-0 mb-1">@{{ article.title }}</h5>
                </a>
                <p>@{{ article.main_body }}</p>
            </div>
        </li>
    </ul>
</template>
<script>
    Vue.component("vue-article-list", {
        template: "#template-article-list",
        data: function () {
            return {
                articleList: [], vifShow: false
            }
        },
        created: function () {
            this.getArticleList();
        },
        methods: {
            getArticleList: function () {
                let thisVue = this;
                let url = COMMUNITY_API_URL.article;
                axios.get(url).then(function (response) {
                    thisVue.articleList = response.data.data;
                    if (thisVue.articleList.length > 0) {
                        thisVue.vifShow = true;
                    }
                }).catch(function (error) {
                    console.error(error.response);
                });
            }
        }
    });
    new Vue({el: "#article-list"});
</script>