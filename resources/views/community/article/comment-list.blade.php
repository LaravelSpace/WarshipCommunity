<template id="template-comment-list">
    <div v-if="vifCommentShow">
        <hr class="my-4">
        <div class="card border-info" style="margin: 10px 0" v-for="comment in commentList">
            <div class="card-header">
                <h6>
                    <img class="rounded-circle mr-3" style="width: 30px; height: 30px"
                         src="" :src="comment.user.avatar" alt="" :alt="comment.user.name">
                    @{{ comment.user.name }}
                    <span class="badge badge-light"># @{{ comment.article_floor }}</span>
                </h6>
            </div>
            <div class="card-body">
                <div v-html="comment.body"></div>
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
        props: ['article_id'],
        data: function () {
            return {
                articleId: this.article_id,
                commentList: [], vifCommentShow: false,
                paginate: [], vifPaginateShow: false
            }
        },
        created: function () {
            this.getCommentList();
        },
        methods: {
            getCommentList: function (page) {
                let thisVue = this;
                let uri = URI_API.article + '/' + thisVue.articleId + URI_CONFIG.comment;
                if (page !== null && page !== "" && page > 0) {
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
            }
        },
        computed: {
            prevPage: function () {
                if (this.paginate.prev_page === null || this.paginate.prev_page === "") {
                    return "disabled";
                }
                return "";
            },
            nextPage: function () {
                if (this.paginate.next_page === null || this.paginate.next_page === "") {
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
