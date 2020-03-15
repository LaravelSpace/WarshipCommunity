<template id="template-comment-list">
    <div v-if="vifCommentShow">
        <hr class="my-4">
        <div class="card border-info" style="margin: 10px 0" v-for="(comment,index) in commentList">
            <div class="card-header">
                <h5>
                    <img class="rounded-circle mr-3" style="width: 30px; height: 30px"
                         src="" :src="comment.user.avatar" alt="" :alt="comment.user.name">
                    @{{ comment.user.name }}
                    <span class="badge badge-light"># @{{ comment.article_floor }}</span>
                </h5>
            </div>
            <div class="card-body">
                <div v-html="comment.body"></div>
                <hr>
                <div v-for="discussion in comment.discussion_list">
                    <div class="alert alert-secondary" role="alert">
                        @ @{{discussion.user.name}} : @{{discussion.body}}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-inline">
                    <input :id="'discussion-'+comment.id" class="form-control" placeholder="最大输入 128 字">
                    <button class="btn btn-outline-success" @click="discussionCreate(comment.id,index)">评论</button>
                </div>
            </div>
        </div>
        <nav aria-label="article paginate navigation" v-if="vifPaginateShow">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item" :class="prevPage">
                    <button class="page-link" aria-label="Previous" @click="getCommentList(paginate.prev_page)">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </button>
                </li>
                <li class="page-item" :class="activePage(page)" v-for="page in paginate.page_list">
                    <button class="page-link" @click="getCommentList(page)">@{{ page }}</button>
                </li>
                <li class="page-item" :class="nextPage">
                    <button class="page-link" aria-label="Next" @click="getCommentList(paginate.next_page)">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
    Vue.component("comment-list", {
        template: "#template-comment-list",
        props: ["article_id"],
        data: function () {
            return {
                articleId: this.article_id,
                commentList: [],
                vifCommentShow: false,
                paginate: [],
                vifPaginateShow: false,
                discussionList: []
            }
        },
        created: function () {
            this.getCommentListWithDiscussion();
        },
        methods: {
            getCommentListWithDiscussion: function (page) {
                let thisVue = this;
                let uri = URI_API.comment
                    + '?classification=' + CLASSIFICATION_WSC.article
                    + '&target_id=' + thisVue.articleId
                    + '&with_discussion=' + true;
                if (!gIsEmpty(page) && page > 0) {
                    uri += '?page=' + page;
                }
                axios.get(uri).then(function (response) {
                    thisVue.commentList = response.data.data.list;
                    if (thisVue.commentList.length > 0) {
                        thisVue.vifCommentShow = true;
                    }
                    thisVue.paginate = response.data.data.paginate;
                    if (thisVue.paginate.length > 0 && thisVue.paginate.page_list.length > 0) {
                        thisVue.vifPaginateShow = true;
                    }
                });
            },
            discussionCreate: function (commentId,index) {
                let thisVue = this;
                let eDiscussion = document.getElementById('discussion-' + commentId);
                let discussionBody = eDiscussion.value;
                let uri = URI_API.discussion + URI_CONFIG.create;
                axios.post(uri, {
                    "comment_id": commentId,
                    "body": discussionBody
                }).then(function (response) {
                    thisVue.commentList[index].discussion_list = response.data.data.list;
                });
            },
            getDiscussionList: function () {
                let commentIdStr = '';
                for (let i = 0; i < this.commentList.length - 1; i++) {
                    commentIdStr += this.commentList[i].id + ','
                }
                commentIdStr += this.commentList[this.commentList.length - 1].id;
            }
        },
        computed: {
            prevPage: function () {
                if (gIsEmpty(this.paginate.prev_page)) {
                    return "disabled";
                }
                return "";
            },
            nextPage: function () {
                if (gIsEmpty(this.paginate.next_page)) {
                    return "disabled";
                }
                return "";
            },
            activePage() {
                return function (page) {
                    if (this.paginate.current_page === page) {
                        return "active";
                    }
                    return "";
                }
            }
        }
    });
    new Vue({el: "#comment-list"});
</script>
