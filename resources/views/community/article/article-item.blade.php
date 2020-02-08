<template id="template-article-item">
    <div class="card border-primary" v-if="vifArticleShow">
        <div class="card-header">
            <h3>
                @{{ articleItem.title }}
                <a class="btn btn-danger" style="float: right;margin-right: 10px"
                   href="" :href="deleteUrl"><h5 class="mt-0 mb-1">删除帖子</h5></a>
                <a class="btn btn-primary" style="float: right;margin-right: 10px"
                   href="" :href="editUrl"><h5 class="mt-0 mb-1">修改帖子</h5></a>
            </h3>
        </div>
        <div class="card-body">
            <div v-html="articleItem.body"></div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" @click="articleStar()">星标</button>
            <button class="btn btn-primary">收藏</button>
        </div>
    </div>
</template>
<script>
    Vue.component("article-item", {
        props: ['article_id'],
        template: "#template-article-item",
        data: function () {
            return {
                articleId: this.article_id,
                articleItem: {},
                editUrl: 'javascript:void(0);',
                deleteUrl: 'javascript:void(0);',
                vifArticleShow: false,
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
                let uri = URI_API.article + '/' + thisVue.articleId;
                axios.get(uri).then(function (response) {
                    thisVue.articleItem = response.data.data;
                    if (thisVue.articleItem !== null && thisVue.articleItem !== '') {
                        thisVue.vifArticleShow = true;
                    }
                });
            },
            articleStar:function(){
                axios.post(uri).then(function (response) {
                    thisVue.articleItem = response.data.data;
                    if (thisVue.articleItem !== null && thisVue.articleItem !== '') {
                        thisVue.vifArticleShow = true;
                    }
                });
            }
        }
    });
    new Vue({el: "#article-item"});
</script>