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
            <button class="" :class="starClass" @click="articleStar()">星标</button>
            <button class="" :class="bookmarkClass" @click="articleBookmark()">收藏</button>
        </div>
    </div>
</template>
<script>
    Vue.component("article-item", {
        props: ["article_id"],
        template: "#template-article-item",
        data: function () {
            return {
                articleId: this.article_id,
                articleItem: {},
                editUrl: 'javascript:void(0);',
                deleteUrl: 'javascript:void(0);',
                vifArticleShow: false,
                isStar: false,
                isBookmark: false,
            }
        },
        created: function () {
            this.getArticleItem();
            this.editUrl = URI_WEB.article + '/' + this.articleId + URI_CONFIG.edit;
            this.deleteUrl = URI_API.article + '/' + this.articleId + URI_CONFIG.delete;
            if (gGetUserId()) {
                this.getAssess('article', this.articleId);
            }
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
            getAssess: function (classification, idStr) {
                let thisVue = this;
                let uri = URI_API.assess;
                axios.get(uri, {
                    'params': {
                        'classification': classification,
                        'id_str': idStr
                    }
                }).then(function (response) {
                    thisVue.isStar = response.data.data.star;
                    thisVue.isBookmark = response.data.data.bookmark;
                });
            },
            articleStar: function () {
                let thisVue = this;
                let uri = URI_API.assess + URI_CONFIG.star + URI_CONFIG.toggle;
                axios.post(uri, {
                    'classification': 'article',
                    'id': this.articleId
                }).then(function (response) {
                    thisVue.isStar = response.data.data.star;
                });
            },
            articleBookmark: function () {
                let thisVue = this;
                let uri = URI_API.assess + URI_CONFIG.bookmark + URI_CONFIG.toggle;
                axios.post(uri, {
                    'classification': 'article',
                    'id': this.articleId
                }).then(function (response) {
                    thisVue.isBookmark = response.data.data.bookmark;
                });
            }
        },
        computed: {
            starClass: function () {
                if (this.isStar) {
                    return "btn btn-success";
                }
                return "btn btn-primary";
            },
            bookmarkClass: function () {
                if (this.isBookmark) {
                    return "btn btn-success";
                }
                return "btn btn-primary";
            }
        }
    });
    new Vue({el: "#article-item"});
</script>