<template id="template-comment-list">
    <div v-if="vifCommentShow">
        <hr class="my-4">
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
        template: "#template-comment-list",
        props: ['article_id'],
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